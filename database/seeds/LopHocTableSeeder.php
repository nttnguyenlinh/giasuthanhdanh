<?php

use Illuminate\Database\Seeder;
use App\LopHoc;
class LopHocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            ['Mầm non'], ['Lớp 1'], ['Lớp 2'], ['Lớp 3'], ['Lớp 4'], ['Lớp 5'], ['Lớp 6'],
            ['Lớp 7'], ['Lớp 8'], ['Lớp 9'], ['Lớp 10'], ['Lớp 11'], ['Lớp 12'],
            ['Lớp ngoại ngữ'], ['Lớp năng khiếu']
        ];
        foreach ($values as $value) {
            $tb = new LopHoc();
            $tb->tenlop = $value[0];
            $tb->save();
        }
    }
}
