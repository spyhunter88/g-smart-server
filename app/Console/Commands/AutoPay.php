<?php namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

use App\Models\Product;
use App\Models\HangSX;
use App\Models\GiaoDich;
use App\Models\KhachHang;

use Illuminate\Support\Facades\Log;

class AutoPay extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $signature = 'autopay';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Auto pay product each hour!';

    /**
    * Create a new command instance
    *
    */
    public function __construct()
    {
        parent::__construct();
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
        // Get new SalesVersion and update Active, Description, Code from product
        $products = Product::where('category_id', 97)
                    ->where('status', 1)
                    ->get();

        foreach ($products as $product) {
            $exception = DB::transaction(function() use ($product) {
                $hangsx = HangSX::where('id',$product->tbl_hangsx_id)->first();
                $kh = KhachHang::where('email',$hangsx->email)->first();

                $product->p_giagoc += $product->giatien;
                $product->save();

                $giaodich = new GiaoDich;
                $giaodich->khachhang_id = $kh->id;
                $giaodich->so_tien_truoc = $hangsx->vitien;
                $giaodich->vi_id = 0;
                $giaodich->so_tien = (-1) * $product->giatien;
                $giaodich->ref = 'SERVER_REQUEST';
                $giaodich->description = 'Trừ hàng giờ.';
                $giaodich->ref_id = $product->request_id;
                $giaodich->created_by = 0;
                $giaodich->save();

                $hangsx->vitien -= $product->giatien;
                $hangsx->save();
            });

            if (!is_null($exception)) {
                Log::error('Can not auto pay hourly for product_id: ' . $product->id);
            }
        }
        
    }
}
