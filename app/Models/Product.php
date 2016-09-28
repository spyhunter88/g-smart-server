<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $connection = 'masterDB';

	protected $table = 'tbl_products';

	protected $primaryKey = 'p_id';

	protected $fillable = [
			'p_name','p_alias','p_xuatxu','p_type','p_masp','p_size','p_dongia',
			'p_hangsx','p_color','p_timeout','p_tinhtrang',/*'p_soluong',*/'p_trangchu',
			'p_muachung','p_phieuban','p_daban','p_mota','p_thongso','download_file',
			'p_video','p_hits','image01','image02','image03','image04','image05','image06',
			'p_order','status',/* 'category_id' ,*/'start_date','tag','tags','p_giamgia',
			'p_tacgia','p_namxb','metatitle','metakey','metadesc','section','lang','p_multi',
			'p_donvi','category_id','p_goi01','p_soluong','p_giagoc','vitien','tbl_hangsx_id',
			'giatien','request_id'
		];

	public $timestamps = false;
}