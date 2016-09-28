<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 

class HangSX extends Model {
	
	protected $connection = 'masterDB';

	protected $table = 'tbl_hangsx';

	protected $fillable = ['title','email','password','phone','company_name','company_address','vitien','active'];

	// protected $timestamps = false;
}