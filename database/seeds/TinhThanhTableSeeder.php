<?php

use Illuminate\Database\Seeder;
use App\TinhThanh;
class TinhThanhTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [['TP HCM']];
        foreach ($values as $value) {
            $tb = new TinhThanh();
            $tb->tentinh = $value[0];
            $tb->save();
        }
    }
}
