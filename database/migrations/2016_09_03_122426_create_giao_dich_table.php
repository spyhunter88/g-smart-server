<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaoDichTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_giao_dich', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('khachhang_id');
            $table->integer('vi_id');
            $table->string('ref');
            $table->integer('ref_id');
            $table->decimal('so_tien', 15);
            $table->decimal('so_tien_truoc', 15);
            $table->string('note');
            $table->string('status', 50);
            $table->string('created_by', 50);
            $table->string('updated_by', 50);
            $table->timestamps();    // Auto add created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('tbl_giao_dich');
    }
}
