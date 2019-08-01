<?php

use Illuminate\Database\Seeder;
use App\MonHoc;
class MonHocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            ['Toán'], ['Lý'], ['Hoá'], ['Văn'], ['Sinh'], ['AVGT'], ['Tiếng Việt'],
            ['Tiếng Anh'], ['Tiếng Trung'], ['Tiếng Nhật'], ['Tiếng Hàn'],
            ['Tin Học'], ['Rèn Chữ'], ['Đàn Piano'], ['Đàn Organ']
        ];
        foreach ($values as $value) {
            $tb = new MonHoc();
            $tb->tenmon = $value[0];
            $tb->save();
        }
    }
}
