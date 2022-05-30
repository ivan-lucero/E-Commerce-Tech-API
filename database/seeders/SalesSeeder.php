<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales')->insert([
            'user_id' => 1,
            'sell_product_id' => 1,
            'amount' => 50.0,
            'confirmed' => false,
        ]);

        DB::table('sales')->insert([
            'user_id' => 2,
            'sell_product_id' => 1,
            'amount' => 50.0,
            'confirmed' => true,
        ]);
        DB::table('sales')->insert([
            'user_id' => 2,
            'sell_product_id' => 1,
            'amount' => 50.0,
            'confirmed' => true,
        ]);
        DB::table('sales')->insert([
            'user_id' => 2,
            'sell_product_id' => 1,
            'amount' => 50.0,
            'confirmed' => false,
        ]);
    }
}
