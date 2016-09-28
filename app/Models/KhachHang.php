<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model {

	protected $table = 'tbl_khachhang';

	protected $fillable = [
        'user_id', 'email', 'name', 'phone', 'company_name', 'company_address'
    ];
}