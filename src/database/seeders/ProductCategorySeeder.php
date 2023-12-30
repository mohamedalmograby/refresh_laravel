<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productCount = 20;
        $categoryCount = 5;

        Product::all()->each(function ($product) use ($categoryCount) {
            $categoryIds = Category::inRandomOrder()->limit(rand(1, $categoryCount))->pluck('id');
            $product->categories()->sync($categoryIds);
        });
    }
}
