<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            //admin
            [
                'nom'=> 'Admin',
                'prenom'=> 'test',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => Hash::make('1111'),
            ],
            //vender
            [

                'nom'=> 'vendor',
                'prenom'=> 'test',
                'email' => 'vendor@gmail.com',
                'role' => 'vendor',
                'status' => 'active',
                'password' => Hash::make('1111'),

            ],
            //customer

           [
            'nom'=> 'customer',
            'prenom'=> 'test',
            'email' => 'customer@gmail.com',
            'role' => 'customer',
            'status' => 'active',
            'password' => Hash::make('1111'),
            ]

        ]);
    }
}
