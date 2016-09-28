<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_elastic_server_request', function(Blueprint $table) {
            $table->increments('id');
            $table->string('khachhang_id');
            $table->string('user_name');
            $table->string('email');
            $table->string('phone');
            $table->string('cpu');
            $table->string('ram');
            $table->string('ssd');
            $table->string('iops');
            $table->string('bandwidth');
            $table->string('ip');
            $table->string('os');
            $table->string('note');
            $table->string('status', 50);
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
        Schema::drop('tbl_elastic_server_request');
    }
}
