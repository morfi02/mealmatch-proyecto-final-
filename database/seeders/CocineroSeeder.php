<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CocineroSeeder extends Seeder
{
    public function run(): void
    {
        $cocineros = [
            ['name' => 'Chef Carlos', 'email' => 'chef1@prueba.com', 'image' => 'chef-profiles/chef1.jpg'],
            ['name' => 'Chef María', 'email' => 'chef2@prueba.com', 'image' => 'chef-profiles/chef2.jpg'],
            ['name' => 'Chef Juan', 'email' => 'chef3@prueba.com', 'image' => 'chef-profiles/chef3.jpg'],
            ['name' => 'Chef Laura', 'email' => 'chef4@prueba.com', 'image' => 'chef-profiles/chef4.jpg'],
            ['name' => 'Chef Pedro', 'email' => 'chef5@prueba.com', 'image' => 'chef-profiles/chef5.jpg'],
            ['name' => 'Chef Sofia', 'email' => 'chef6@prueba.com', 'image' => 'chef-profiles/chef6.jpg'],
            ['name' => 'Chef Antonio', 'email' => 'chef7@prueba.com', 'image' => 'chef-profiles/chef7.jpg'],
            ['name' => 'Chef Julia', 'email' => 'chef8@prueba.com', 'image' => 'chef-profiles/chef8.jpg'],
            ['name' => 'Chef Miguel', 'email' => 'chef9@prueba.com', 'image' => 'chef-profiles/chef9.jpg'],
            ['name' => 'Chef Elena', 'email' => 'chef10@prueba.com', 'image' => 'chef-profiles/chef10.jpg'],
        ];

        foreach ($cocineros as $cocinero) {
            User::create([
                'name' => $cocinero['name'],
                'email' => $cocinero['email'],
                'password' => Hash::make('password123'),
                'rol' => 'cocinero',
                'profile_photo_url' => $cocinero['image'], // Guarda la ruta relativa
            ]);
        }
    }
}
