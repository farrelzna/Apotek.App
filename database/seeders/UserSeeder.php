<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'adminapotek0@gmail.com',
            'role' => 'Admin',
            'password' => Hash::make('adminapotek0'),
        ]);

        //Apoteker
        User::create([
            'name' => 'Apoteker',
            'email' => 'apoteker0@gmail.com',
            'role' => 'Apoteker',
            'password' => Hash::make('apoteker0'),
        ]);
    }
}
