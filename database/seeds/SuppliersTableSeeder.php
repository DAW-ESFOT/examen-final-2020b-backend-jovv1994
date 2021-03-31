<?php

use Illuminate\Database\Seeder;
use App\Supplier;
use Tymon\JWTAuth\Facades\JWTAuth;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla suppliers.
        Supplier::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos la lista de todos los usuarios creados e
        //iteramos sobre cada uno y simulamos un inicio de
        //sesión con cada uno para crear proveedores en su nombre
        $users = App\User::all();
        foreach ($users as $user) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt([
                'email' => $user->email,
                'password' => '123123'
            ]);
            // Y ahora con este usuario creamos algunos proveedores
            $num_suppliers = 5;
            for ($j = 0; $j < $num_suppliers; $j++) {
                Supplier::create([
                    'name' => $faker->firstName
                ]);
            }
        }
    }
}
