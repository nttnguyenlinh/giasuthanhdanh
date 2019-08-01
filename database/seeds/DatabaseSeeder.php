<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             MonHocTableSeeder::class,
             LopHocTableSeeder::class,
             TinhThanhTableSeeder::class,
             KhuVucTableSeeder::class,
             AdminsTableSeeder::class,
             GiaSuTableSeeder::class,
         ]);
    }
}
