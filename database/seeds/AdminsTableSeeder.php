<?php

use Illuminate\Database\Seeder;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Xuân Thiều',
            'email' => 'gsthanhdanh@gmail.com',
            'password' => bcrypt('thieu'),
            'is_active' => 1
        ]);
    }
}
