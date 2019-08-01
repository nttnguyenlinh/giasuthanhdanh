<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhieuMoLopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_mo_lop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('malop')->unsigned()->index();
            $table->string('slug')->unique();
            $table->bigInteger('madk')->unsigned();
            $table->foreign('madk')->references('id')->on('phieu_dang_ky')->onUpdate('cascade')->onDelete('restrict');
            $table->string('lopday', 30);
            $table->string('monday', 100);
            $table->tinyInteger('loailop')->default(1);
            $table->string('diachi', 50);
            $table->decimal('luong', 10, 0);
            $table->tinyInteger('lephi')->default(20);
            $table->tinyInteger('sobuoihoc')->default(2);
            $table->string('thoigianhoc', 50);
            $table->string('thongtin', 100)->nullable();
            $table->string('yeucau', 100)->nullable();
            $table->boolean('trangthai')->default(0);
            $table->timestamps();
        });

//        Schema::table('phieu_mo_lop', function (Blueprint $table) {
//            $table->bigInteger('id', true, true)->change();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieu_mo_lop');
    }
}
