<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReservationDetail;

class ReservationDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservationDetails = [
            [
                'reservation_id' => 1,
                'reservation_date' => '2025-11-05',
                'start' => '13:30:00',
                'end' => '15:00:00',
                'type_id' => 1,
                'descriptions' => 'Lorem Ipsum Dolor',
            ],
        ];

        foreach ($reservationDetails as $detail) {
            ReservationDetail::create($detail);
        }
    }
}
