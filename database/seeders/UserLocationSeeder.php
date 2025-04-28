<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Localidades reales de Lanzarote
        $locations = [
            'Arrecife',
            'Teguise',
            'San Bartolomé',
            'Tinajo',
            'Haría',
            'Yaiza',
            'Tías',
            'Playa Blanca',
            'Puerto del Carmen',
            'Costa Teguise',
        ];

        // Actualizar usuarios con localizaciones aleatorias
        User::all()->each(function ($user) use ($locations) {
            $user->update([
                'location' => $locations[array_rand($locations)],
            ]);
        });
    }
}
