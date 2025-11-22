<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classroom;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            ['class' => 'X TKJ 1'], // 1
            ['class' => 'X TKJ 2'], // 2
            ['class' => 'X AKL'], // 3
            ['class' => 'X PM'], // 4
            ['class' => 'XI TKJ 1'], // 5
            ['class' => 'XI TKJ 2'], // 6
            ['class' => 'XI TKJ 3'], // 7
            ['class' => 'XI AKL'], // 8
            ['class' => 'XI PM'], // 9
            ['class' => 'XII TKJ 1'], // 10
            ['class' => 'XII TKJ 2'], // 11
            ['class' => 'XII TKJ 3'], // 12
            ['class' => 'XII AKL 1'], // 13
            ['class' => 'XII AKL 2'], // 14
            ['class' => 'XII PM'], // 15
            ['class' => 'External'], // 16
            ['class' => 'Teacher'], // 17
        ];

        foreach ($classes as $class) {
            Classroom::create($class);
        }
    }
}
