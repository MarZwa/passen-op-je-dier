<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pets = Pet::all();
        $requests = [];

        foreach ($pets as $pet) {
            $request = [
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d'),
                'rate' => 10.50,
                'pet_id' => $pet->id
            ];
            $requests[] = $request;
        }
        Request::insert($requests);
    }
}
