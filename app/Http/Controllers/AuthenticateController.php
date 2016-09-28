<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\KhachHang;
use App\Models\HangSX;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    //
    public function __construct() {
    	$this->middleware('jwt.auth', ['except'=> ['authenticate','register']]);
    }

    /**
    *	Display a listing of the resource
    */
    public function index() {
    	return "Auth Index";
    }

    /**
    *	Authenticate user
    */
    public function authenticate(Request $request) {
    	$credentials = $request->only('email', 'password');

    	try {
    		// verify the credentials and create a token for user
    		if (!$token = JWTAuth::attempt($credentials)) {
    			return response()->json(['error' => 401, "error_code" => 'invalid_credentials']);
    		}
    	} catch (JWTException $e) {
    		// something wrong
    		return response()->json(['error' => 401, "error_code" => 'could_not_create_token']);
    	}

    	// if no errors, we return JWT
    	return response()->json(compact('token'));
    }

    /**
    *	Get current authenticated user
    */
    public function getAuthenticatedUser() {
    	try {
    		if ( !$user = JWTAuth::parseToken()->authenticate()) {
    			return response()->json(['error' => 'user_not_found'], 404);
    		}
    	} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    		return response()->json(['token_expired'], $e->getStatusCode());
    	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    		return response()->json(['token_invalid'], $e->getStatusCode());
    	} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
    		return response()->json(['token_absent'], $e->getStatusCode());
    	}

        $ur = array('user' => array('id' => $user->id, 'name' => $user->name, 'email' => $user->email ));

    	// the token is valid
    	return response()->json($ur);
    }

    /**
    *   Register via json
    */
    public function register(Request $request) {
        $data = $request->only('name', 'email', 'password', 'phone', 'company_name', 'company_address');

        $count = User::where('email', $data['email'])
                    ->get()->count();
        $count = ($count == 0 ? HangSX::where('email', $data['email'])->get()->count() : $count);

        if ($count > 0) {
            return response()->json(['error' => '101', 'message' => 'Email already exists!']);
        }

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $exception = DB::transaction(function() use ($data, $user) {
            $user->save();

            // Create khach hang
            KhachHang::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'phone' => $data['phone'],
                'company_name' => $data['company_name'],
                'company_address' => $data['company_address']
            ]);

            HangSX::create([
                'title' => $user->name,
                'email' => $user->email,
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'],
                'company_name' => $data['company_name'],
                'company_address' => $data['company_address'],
                'vitien' => 10000000
            ]);
        });
        
        if (!is_null($exception)) {
            return response()->json([ 'error' => 31, 'message' => $exception->getMessage() ]);
        }

        // Remove password from user
        unset($user->password);

        return response()->json($user);
    }
}
