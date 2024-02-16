<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::truncate();

        User::create([
            "username" => ("diogo97"),
            "name"=> ("Diogo Fernandes"),
            "email"=> ("diogo.fernandes@gmail.com"),
            "password"=> ("password"), // não preciso usar hash aqui porque ja defini no modelo 
            "is_admin" => true,
        ]);

        User::create([
            "username" => ("filipe97"),
            "name"=> ("Filipe Fernandes"),
            "email"=> ("filipe.fernandes@gmail.com"),
            "password"=> ("password"), 
            "is_admin" => false,
        ]);

        User::create([
            "username" => ("joana97"),
            "name"=> ("Joana Pereira"),
            "email"=> ("joana.pereira@gmail.com"),
            "password"=> ("password"), 
            "is_admin" => false,
        ]);

        User::create([
            "username" => ("ana97"),
            "name"=> ("Ana Reis"),
            "email"=> ("ana.reis@gmail.com"),
            "password"=> ("password"),
            "is_admin" => false,
        ]);

        User::create([
            "username" => ("carlos97"),
            "name"=> ("Carlos Teixeira"),
            "email"=> ("carlos.teixeira@gmail.com"),
            "password"=> ("password"),  
            "is_admin" => false,
        ]);

        User::create([
            "username" => ("bruno97"),
            "name"=> ("Bruno Barbosa"),
            "email"=> ("bruno.barbosa@gmail.com"),
            "password"=> ("password"),
            "is_admin" => false,
        ]);

        User::create([
            "username" => ("pedro97"),
            "name"=> ("Pedro Ferreira"),
            "email"=> ("pedro.ferreira@gmail.com"),
            "password"=> ("password"),
            "is_admin" => false,
        ]);

        User::create([
            "username" => ("pedro98"),
            "name"=> ("Pedro Jesus"),
            "email"=> ("pedro.jesus@gmail.com"),
            "password"=> ("password"), 
            "is_admin" => false,
        ]);
    }
}