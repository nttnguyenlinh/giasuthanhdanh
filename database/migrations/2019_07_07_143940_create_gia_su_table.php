<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiaSuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gia_su', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('holot', 30);
            $table->string('ten', 30);
            $table->date('ngaysinh');
            $table->boolean('gioitinh')->default(0);
            $table->string('noisinh', 20);
            $table->string('cmnd', 12)->unique();
            $table->string('diachi', 50);
            $table->string('quanhuyen', 20);
            $table->string('tinhthanh', 20);
            $table->string('email', 30)->unique();
            $table->string('sdt', 10)->unique();
            $table->string('password')->nullable();
            $table->string('truonghoc');
            $table->string('nganhhoc');
            $table->string('namtn');
            $table->string('trinhdo');
            $table->string('monday');
            $table->string('lopday');
            $table->string('khuvucday');
            $table->string('thongtinkhac')->nullable();;
            $table->string('anhthe')->nullable();;
            $table->string('anhcmnd')->nullable();;
            $table->boolean('trangthai')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('gia_su');
    }
}
