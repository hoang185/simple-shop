<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'cat_id' => 1,
            'name' => Str::random(7),
            'image' => Str::random(10).'@gmail.com',
            'price' => 1000000,
            'quantity' => 2,
            'product_sale' => 1,
            'product_new' => 1,
            'product_best' => 1,
        ]);
    }
}
