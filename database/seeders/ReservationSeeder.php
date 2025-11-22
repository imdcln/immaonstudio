<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            ['user_id' => 1, 'status_id' => 1],
        ];

        foreach ($reservations as $res) {
            Reservation::create($res);
        }
    }
}
