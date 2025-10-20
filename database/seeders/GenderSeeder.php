<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gender;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            ['gender' => 'Male'],
            ['gender' => 'Female'],
            ['gender' => 'Rather Not Say']
        ];

        foreach ($genders as $gender) {
            Gender::create($gender);
        }
    }
}
