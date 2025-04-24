<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'role' => 'superadmin',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@mail.com',
            'role' => 'kasir',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@mail.com',
            'role' => 'pimpinan',
            'password' => Hash::make('password'),
        ]);
    }
}
