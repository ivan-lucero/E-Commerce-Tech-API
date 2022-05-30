<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' => 1,
            'category_id' => 1,
            'name' => "AMD Ryzen 3 3200G",
            'price' => "21000.0",
        ]);
        DB::table('products')->insert([
            'id' => 2,
            'category_id' => 2,
            'name' => "RAM 8 gb",
            'price' => "5000.0",
        ]);
        DB::table('products')->insert([
            'id' => 3,
            'category_id' => 3,
            'name' => "SSD 240gb",
            'price' => "3000.0",
        ]);
        DB::table('products')->insert([
            'id' => 4,
            'category_id' => 4,
            'name' => "motherboard AMD",
            'price' => "6000.0",
        ]);
    }
}
