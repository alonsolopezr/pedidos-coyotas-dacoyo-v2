<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admins = [
            1 => [
                "name" => "Iris",
                "lastname" => "Meza Valencia",
                "email" => "irismezadelopez@gmail.com",
                "celular" => "6623072829",
                "password" => Hash::make('123lopezMeza321'),
                "is_admin" => 1,
                "is_client" => 0,
            ],
            2 => [
                "name" => "Oscar",
                "lastname" => "Fontes Meza",
                "email" => "oscarfontesmeza@gmail.com",
                "celular" => "6624795657",
                "password" => Hash::make('123Oscarin321'),
                "is_admin" => 1,
                "is_client" => 0,
            ],
            3 => [
                "name" => "Lorenia",
                "lastname" => "Valencia Ibarra",
                "email" => "loreniavalencia@yahoo.com.mx",
                "celular" => "6621480702",
                "password" => Hash::make('1972LoreniaValencia'),
                "is_admin" => 1,
                "is_client" => 0,
            ],
            4 => [
                "name" => "Alonso",
                "lastname" => "Lopez Romo",
                "email" => "alonso.lopez.r@gmail.com",
                "celular" => "6621379254",
                "password" => Hash::make('123123123'),
                "is_admin" => 1,
                "is_client" => 0,
            ],
            5 => [
                "name" => "Cliente Alonso",
                "lastname" => "Lopez Romo",
                "email" => "alonsolopez@uthermosillo.edu.mx",
                "celular" => "6621379254",
                "password" => Hash::make('123123123'),
                "is_admin" => 0,
            ],
        ];

        foreach ($admins as $key => $admin)
        {
            # code...
            DB::table('users')->insert($admin);
        }
    }
}