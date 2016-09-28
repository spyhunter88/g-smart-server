<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 

class GiaoDich extends Model {
	protected $table = 'tbl_giao_dich';

	protected $fillable = [
        'khachhang_id', 'vi_id', 'ref', 'ref_id', 'so_tien', 'so_tien_truoc', 'description', 'note', 'status', 'created_by', 'updated_by'
    ];
}