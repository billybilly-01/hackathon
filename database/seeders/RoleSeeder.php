<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'user'],
            ['name' => 'candidat'],
            ['name' => 'recruteur'],
            ['name' => 'entreprise'],
            ['name' => 'partenaire'],
            ['name' => 'visiteur'],
            ['name' => 'super_admin'],
        ]);
    }
}
