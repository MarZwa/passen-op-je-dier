<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $roles = ['Owner', 'Sitter'];
        $users = [];

        foreach (range(1, 2) as $index) {
            $user = [
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $faker->email(),
                'password' => Hash::make('test'),
                'role' => $roles[$index - 1],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $users[] = $user;
        }

        $users[] = [
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.nl',
            'password' => Hash::make('admin'),
            'role' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        User::insert($users);
    }
}
