<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Produto 1', 'price' => 10.99],
            ['name' => 'Produto 2', 'price' => 19.99],
            ['name' => 'Produto 3', 'price' => 5.99],
        ];

        foreach ($products as $productData) {
            $product = new Product();
            $product->name = $productData['name'];
            $product->price = $productData['price'];
            $product->save();
        }
    }
}
