<?php

use Illuminate\Database\Seeder;
use App\KhuVuc;
class KhuVucTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            ['Quận 1', 1], ['Quận 2', 1], ['Quận 3', 1], ['Quận 4', 1], ['Quận 5', 1], ['Quận 6', 1],
            ['Quận 7', 1], ['Quận 8', 1], ['Quận 9', 1], ['Quận 10', 1], ['Quận 11', 1], ['Quận 12', 1],
            ['Gò Vấp', 1], ['Bình Tân', 1], ['Bình Thạnh', 1], ['Phú Nhuận', 1], ['Tân Bình', 1],
            ['Tân Phú', 1], ['Thủ Đức', 1], ['Củ Chi', 1], ['Hóc Môn', 1], ['Bình Chánh', 1],
            ['Nhà Bè', 1], ['Cần Giờ', 1]
        ];
        foreach ($values as $value) {
            $tb = new KhuVuc();
            $tb->tenkv = $value[0];
            $tb->matinh = $value[1];
            $tb->save();
        }
    }
}
