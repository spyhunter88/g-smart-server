<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_vi', function(Blueprint $table) {
            $table->increments('id');
            $table->string('khachhang_id');
            $table->decimal('so_tien', 15);
            $table->string('status', 50);
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
        Schema::drop('tbl_vi');
    }
}
