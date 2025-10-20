<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role' => 'User'], // 1
            ['role' => 'Supervisor'], // 2
            ['role' => 'Tester'], // 3
            ['role' => 'Admin'], // 4
            ['role' => 'Co-Founder'], // 5
            ['role' => 'Founder'], // 6
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
