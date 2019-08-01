<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhieuDangKyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_dang_ky', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hoten', 30);
            $table->string('diachi', 50);
            $table->string('email', 30)->nullable();
            $table->string('sdt', 10);
            $table->string('lophoc', 30);
            $table->string('monhoc', 100);
            $table->tinyInteger('loailop')->default(1);
            $table->string('sohocsinh', 30)->nullable();
            $table->string('hocluc', 30)->nullable();
            $table->tinyInteger('sobuoihoc');
            $table->string('thoigianhoc', 50);
            $table->string('yeucau', 50);
            $table->string('yeucauthem', 50)->nullable();
            $table->boolean('trangthai')->default(0);
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
        Schema::dropIfExists('phieu_dang_ky');
    }
}
