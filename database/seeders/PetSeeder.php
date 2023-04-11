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
        $descriptions = [
            'Joey is een krolse kat, die graag bij je op schoot komt liggen.',
            'Jim is een kleine dwerghamster, met hele dikke wangetjes. Hij eet heel veel.',
            'Stan is een hele lieve golden retriever, een echte emotionele support hond.',
            'Emiel de capibara is zeker geen kleintje, maar wel een lieverd.'
        ];
        $images = ['pets/kat.jpg', 'pets/hamster.jpg', 'pets/hond.jpg', 'pets/capibara.jpeg'];

        $users = User::all();
        $pets = [];
        $counter = 0;

        foreach ($users as $user) {
            if ($counter < 4) {
                foreach (range(1, 2) as $index) {
                    $pet = [
                        'name' => $names[$counter],
                        'kind' => $animals[$counter],
                        'description' => $descriptions[$counter],
                        'picture' => $images[$counter],
                        'owner_id' => $user->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $pets[] = $pet;
                    $counter++;
                }
            }
        }
        Pet::insert($pets);
    }
}
