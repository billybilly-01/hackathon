<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role_id' => 8, // Assurez-vous que l'ID du rôle admin existe dans la table roles
            'password' => Hash::make('password'), // Change le mot de passe si besoin
        ]);
    }
}
