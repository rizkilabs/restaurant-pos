<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
            ],
            [
                'name' => 'Kasir 1',
                'email' => 'kasir1@example.com',
                'password' => Hash::make('password'),
                'role' => 'kasir',
            ],
            [
                'name' => 'Pimpinan 1',
                'email' => 'pimpinan1@example.com',
                'password' => Hash::make('password'),
                'role' => 'pimpinan',
            ],
            [
                'name' => 'Kasir 2',
                'email' => 'kasir2@example.com',
                'password' => Hash::make('password'),
                'role' => 'kasir',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
