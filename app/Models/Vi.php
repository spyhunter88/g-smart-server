<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vi extends Model {
	protected $table = 'tbl_vi';

	protected $fillable = [
        'khachhang_id', 'so_tien', 'status', 'updated_by'
    ];
}