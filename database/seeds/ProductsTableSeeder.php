<?php

use App\Product;
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
        // Vaciar la tabla.
        Product::truncate();
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'name' => $faker->firstName,
                'code' => $faker->uuid,
                'price' => $faker->randomNumber(2),
                'status' => 'active',
            ]); }
    }
}
