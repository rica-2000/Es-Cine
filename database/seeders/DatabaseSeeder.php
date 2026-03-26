<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $demoUsers = [
            [
                'name' => 'Administrador Cine',
                'email' => 'admin@cine.com',
                'role' => 'admin',
                'password' => Hash::make('Admin12345!'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Operador Cine',
                'email' => 'operador@cine.com',
                'role' => 'usuario',
                'password' => Hash::make('Operador123!'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Invitado Demo',
                'email' => 'demo@cine.com',
                'role' => 'usuario',
                'password' => Hash::make('Demo12345!'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($demoUsers as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'role' => $userData['role'],
                    'password' => $userData['password'],
                    'email_verified_at' => $userData['email_verified_at'],
                ]
            );
        }
    }
}
