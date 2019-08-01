<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhieuNhanLopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieu_nhan_lop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lop')->unsigned()->index();
            $table->bigInteger('giasu')->unsigned();
            $table->date('thoigianday')->nullable();
            $table->string('ghichu', 150)->nullable();
            $table->boolean('trangthai')->default(0);
            $table->timestamps();
            $table->foreign('giasu')->references('id')->on('gia_su')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('lop')->references('malop')->on('phieu_mo_lop')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieu_nhan_lop');
    }
}
