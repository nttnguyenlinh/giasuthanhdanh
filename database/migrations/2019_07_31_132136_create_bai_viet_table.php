<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaiVietTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bai_viet', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tieude')->unique();
            $table->string('slug')->unique();
            $table->tinyInteger('danhmuc')->nullable()->default(1);
            $table->string('mota')->nullable();
            $table->longText('noidung')->nullable();
            $table->string('anhbia')->nullable();
            $table->tinyInteger('trangthai')->default(1);
            $table->tinyInteger('xoa')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bai_viet');
    }
}
