<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            
            'imagePath' => 'https://img.thewhiskyexchange.com/900/rum_cap2.jpg',
            'title' => 'Captain Morgan',
            'description' => 'Skanus Romas',
            'price' => '5.5'
        ]);
        $product->save(); ////
    }
}
