<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerRequest extends Model {

	protected $table = 'tbl_elastic_server_request';

	protected $fillable = [
        'khachhang_id', 'user_name', 'email', 'phone', 'cpu', 'ram', 'ssd', 'iops', 'bandwidth', 'ip', 'os', 'note', 'status'
    ];
}