<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReservationType;

class ReservationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservationTypes = [
            ['name' => 'Single'],
            ['name' => 'Multi'],
        ];

        foreach ($reservationTypes as $type) {
            ReservationType::create($type);
        }
    }
}
