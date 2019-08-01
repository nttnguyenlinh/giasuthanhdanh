<?php

use Illuminate\Database\Seeder;

class GiaSuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gia_su')->insert([
            'holot' => 'Cao Xuân',
            'ten' => 'Thiều',
            'ngaysinh' => '1985-07-09 00:00:00',
            'gioitinh' => 1,
            'noisinh' => 'Huế',
            'cmnd' => '123456789',
            'diachi' => '123 Thành Thái',
            'quanhuyen' => 'Quận 10',
            'tinhthanh' => 'TP HCM',
            'email' => 'xuanthieu@gmail.com',
            'sdt' => '123456789',
            'password' => bcrypt('09071985'),
            'truonghoc' => 'ĐH Nguyễn Tất Thành',
            'nganhhoc' => 'CNTT',
            'namtn' => '2000',
            'trinhdo' => 'Thạc Sĩ',
            'monday' => '1,2,3',
            'lopday' => '9,10,11,12',
            'khuvucday' => '1,3,4',
            'trangthai' => 1
        ]);
    }
}
