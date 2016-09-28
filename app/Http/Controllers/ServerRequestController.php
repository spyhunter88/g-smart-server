<?php

namespace App\Http\Controllers;

use Mail;
use DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Requests;
use JWTAuth;
use App\User;
use App\Models\KhachHang;
use App\Models\ServerRequest;
use App\Models\HangSX;
use App\Models\GiaoDich;
use App\Models\Product;

class ServerRequestController extends Controller
{
    // Tao Elastic Server Request
    public function create(Request $request) {
    	if ( !$user = JWTAuth::parseToken()->authenticate()) {
			return response()->json(['error' => 'user_not_found'], 404);
		}

    	if ($request->isJSON()) {
    		$data = $request->json();
    		$svr = (object)$data->get('server');

    		$kh = KhachHang::where('email', $user->email)->first();

    		if ($kh == null) {
    			return response()->json([ 'error'=> 11, 'message' => 'Thông tin khách hàng không hợp lệ!' ]);
    		}

    		/** LOAI BO 
    		$vi = Vi::where('khachhang_id', $kh->id)->first();
    		if ($vi == null) {
    			return response()->json([ 'error' => 21, 'message' => 'Ví chưa tồn tại, bạn cần tạo ví!' ]);
    		}
    		*/

    		$svrRequest = new ServerRequest;
    		$svrRequest->khachhang_id = $kh->id;
			$svrRequest->user_name = $kh->name;
			$svrRequest->email = $kh->email;
			$svrRequest->phone = $kh->phone;
			$svrRequest->cpu = $svr->cpu;
			$svrRequest->ram = $svr->ram;
			$svrRequest->ssd = $svr->ssd;
			$svrRequest->iops = $svr->iops;
			$svrRequest->bandwidth = $svr->bandwidth;
			$svrRequest->ip = $svr->ip;
			$svrRequest->os = $svr->os;
			$svrRequest->status = 'NEW';
			$svrRequest->price_hour = $svr->cpu * 300 + $svr->ram * 200 + $svr->ssd * 10
										+ ($svr->iops / 200 - 14) * 100 + $svr->bandwidth * 150 + $svr->ip * 100;
			$svrRequest->price_month = $svrRequest->price_hour * 720;

			if ($svrRequest->price_hour != $svr->price_h || $svrRequest->price_month != $svr->price_m) {
				return response()->json([ 'error' => 22, 'message' => 'Thông tin giá không hợp lệ!' ]);
			}

			/* Check giá */
			$hangsx = HangSX::where('email', $user->email)->first();
			if ($svrRequest->price_hour > $hangsx->vitien) {
				return response()->json([ 'error' => 23, 'message' => 'Ví không đủ tiền để thực hiện giao dịch!' ]);
			}

			$exception = DB::transaction(function() use ($kh, $user, $svr, $svrRequest, $hangsx) {
				$svrRequest->save();

				$giaodich = new GiaoDich;
				$giaodich->khachhang_id = $kh->id;
				// $giaodich->vi_id = $vi->id;
				$giaodich->so_tien_truoc = $hangsx->vitien;
				$giaodich->vi_id = 0;
				$giaodich->so_tien = (-1) * $svrRequest->price_hour;
				$giaodich->ref = 'SERVER_REQUEST';
				$giaodich->description = 'Trừ lần đầu đăng ký.';
				$giaodich->ref_id = $svrRequest->id;
				$giaodich->created_by = $user->id;
				$giaodich->save();

				$hangsx->vitien = $hangsx->vitien - $svrRequest->price_hour;
				$hangsx->save();

				Product::create([
					'category_id' => 97,
					'p_goi01' => json_encode($svr),
					'p_soluong' => Carbon::now()->format('y-m-d'),
					'p_giagoc' => $svrRequest->price_hour,
					'p_name'=> '1',
					'p_alias'=> '1',
					'p_xuatxu'=> 0,
					'p_type'=> '1',
					'p_masp'=> '1',
					'p_size'=> '1',
					'p_dongia'=> '1',
					'p_hangsx'=> 0,
					'p_color'=> '1',
					'p_timeout'=> '1',
					'p_tinhtrang'=> '1',
					'p_trangchu'=> '1',
					'p_muachung'=> '1',
					'p_phieuban'=> 0,
					'p_daban'=> 0,
					'p_mota'=> '1',
					'p_thongso'=> '1',
					'download_file'=> '1',
					'p_video'=> '1',
					'p_hits'=> 0,
					'image01'=> '1',
					'image02'=> '1',
					'image03'=> '1',
					'image04'=> '1',
					'image05'=> '1',
					'image06'=> '1',
					'p_order'=> 0,
					'status'=> 1,
					'start_date'=> Carbon::now(),
					'tag'=> '1',
					'tags'=> '1',
					'p_giamgia'=> 0,
					'p_tacgia'=> '1',
					'p_namxb'=> '1',
					'metatitle'=> '1',
					'metakey'=> '1',
					'metadesc'=> '1',
					'section'=> '1',
					'lang'=> '1',
					'p_multi'=> '1',
					'giatien' => $svrRequest->price_hour,
					'tbl_hangsx_id' => $hangsx->id,
					'request_id' => $svrRequest->id
				]);
			});

			if (!is_null($exception)) {
				return response()->json([ 'error' => 31, 'message' => $exception->getMessage() ]);
			}

			// Send mail
			// $receiver = [ 'linhnh@gdata.com.vn', 'ha@gdata.com.vn' ];
			$receiver = [ 'linhnh@gdata.com.vn' ];
			$to_dev = true;
			$mail_subject = '[GDATA] Yêu cầu khởi tạo Server!';
			Mail::send('mail.serverRequest', ['svr' => $svrRequest, 'to_dev' => $to_dev], function($m) use ($kh, $mail_subject, $receiver) {
				$m->from('info@gdata.com.vn', $mail_subject);
				$m->to($receiver)->subject($mail_subject);
			});
			$to_dev = false;
			Mail::send('mail.serverRequest', ['svr' => $svrRequest, 'to_dev' => $to_dev], function($m) use ($kh, $mail_subject) {
				$m->from('info@gdata.com.vn', $mail_subject);
				$m->to($kh->email, $kh->name)->subject($mail_subject);
			});
    	}
    }

    public function index(Request $request) {
    	$rs = serverRequest::all();
    	return response()->json($rs);
    }
}
