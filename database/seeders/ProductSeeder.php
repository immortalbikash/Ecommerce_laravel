<?php

namespace Database\Seeders;

use App\Models\Brands;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// afai faker haleko talako
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Config as FacadesConfig;
use PSpell\Config;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach(range(1, 100) as $value){
            Product::create([
                'name' => $faker->randomElement(Brands::pluck('name')) . ' Watch',
                'price' => $faker->numberBetween($min = 5000, $max = 100000),
                'sale_price' => $faker->numberBetween($min = 500, $max = 4999),
                // 'color' =>$faker->colorName(),
                'color' => $faker->randomElement(FacadesConfig::get('colors')),
                'brand_id' => $faker->randomElement(Brands::pluck('id')),
                'product_code' => $faker->numerify('LV-###'),
                'gender' => $faker->randomElement(['Male', 'Female', 'Children', 'Unisex']),
                'function' => $faker->randomElement(FacadesConfig::get('watch_functions')),
                'stock' => $faker->randomNumber() ,
                'description' => $faker->text($maxNbChars = 200),
                'image' => $faker->imageUrl($width = 640, $height = 480),
                'is_active' =>$faker->randomElement(['1', '0']),
            ]);
        }
    }
}
