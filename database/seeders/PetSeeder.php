<?php

namespace Database\Seeders;

use App\Enums\Animals;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Joey', 'Jim', 'Stan', 'Emiel'];
        $animals = [Animals::Cat->value, Animals::Hamster->value, Animals::Dog->value, Animals::Capibara->value];

        $users = User::all();
        $pets = [];
        $counter = 0;

        foreach ($users as $user) {
            foreach (range(1, 2) as $index) {
                $pet = [
                    'name' => $names[$counter],
                    'kind' => $animals[$counter],
                    'owner_id' => $user->id
                ];
                $pets[] = $pet;
                $counter++;
            }
        }
        Pet::insert($pets);
    }
}
