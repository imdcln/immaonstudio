<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReservationStatus;

class ReservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservationStatus = [
            ['status' => 'Accepted'],
            ['status' => 'Pending'],
            ['status' => 'Declined'],
        ];

        foreach ($reservationStatus as $status) {
            ReservationStatus::create($status);
        }
    }
}
