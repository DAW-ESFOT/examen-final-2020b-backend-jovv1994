<?php

use App\Product;
use App\Supplier;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciamos la tabla products
        Product::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos todos los clientes de la bdd
        $customers = App\Customer::all();
        // Obtenemos todos los usuarios
        $users = App\User::all();
        foreach ($users as $user) {
            // iniciamos sesión con cada uno
            JWTAuth::attempt([
                'email' => $user->email,
                'password' => '123123'
            ]);
            // Creamos un producto para cada cliente con este usuario
            foreach ($customers as $customer) {
                $product = Product::create([
                    'name' => $faker->firstName,
                    'code' => $faker->uuid,
                    'price' => $faker->randomNumber(2),
                    'status' => 'active',
                    'customer_id' => $customer->id,
                ]);
                $product->suppliers()->saveMany(
                    $faker->randomElements(
                        array(
                            Supplier::find(1),
                            Supplier::find(2),
                            Supplier::find(3)
                        ), $faker->numberBetween(1, 3), false)
                );
            }
        }
    }
}


