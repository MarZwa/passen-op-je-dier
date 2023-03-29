<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

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
                'password' => 'test',
                'role' => $roles[$index - 1],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $users[] = $user;
        }
        User::insert($users);
    }
}
