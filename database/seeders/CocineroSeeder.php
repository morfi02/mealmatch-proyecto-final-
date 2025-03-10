<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CocineroSeeder extends Seeder
{
    public function run(): void
    {
        
        User::create([
            'name' => 'chef jorge',
            'email' => 'chefjorge@prueba.com',
            'password' => Hash::make('chefjorge'),
            'rol' => 'cocinero', 
        ]);
    }
}
