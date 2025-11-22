<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'role_id' => 6, // Founder
                'username' => 'imdclne',
                'first_name' => 'Declane',
                'last_name' => 'Joseph',
                'email' => 'declanecun@gmail.com',
                'password' => Hash::make('declane123'),
                'class_id' => 12,
                'gender_id' => 1,
                'birth_date' => '2008-01-04',
                'profile_picture' => 'dcln04profile',
                'email_verified' => true,
            ],
            [
                'role_id' => 5, // Co-Founder
                'username' => 'imjason',
                'first_name' => 'Jason',
                'last_name' => 'Valentino',
                'email' => 'imjason@gmail.com',
                'password' => Hash::make('jason123'),
                'class_id' => 12,
                'gender_id' => 1,
                'birth_date' => '2008-08-08',
                'email_verified' => true,
            ],
            [
                'role_id' => 5, // Co-Founder
                'username' => 'imsilvi',
                'first_name' => 'Silviana',
                'last_name' => 'Febrianti',
                'email' => 'silviana@gmail.com',
                'password' => Hash::make('silvi123'),
                'class_id' => 12,
                'gender_id' => 2,
                'birth_date' => '2008-08-08',
                'email_verified' => true,
            ],
            [
                'role_id' => 3, // Tester
                'username' => 'imying',
                'first_name' => 'Ying Er',
                'last_name' => 'Aleitheia Fangidaer',
                'email' => 'imying@gmail.com',
                'password' => Hash::make('ying123'),
                'class_id' => 12,
                'gender_id' => 2,
                'birth_date' => '2008-08-08',
                'email_verified' => true,
            ],
            [
                'role_id' => 1, // User
                'username' => 'impeter',
                'first_name' => 'Peter',
                'last_name' => 'Cleon Xu',
                'email' => 'impeter@gmail.com',
                'password' => Hash::make('peter123'),
                'class_id' => 12,
                'gender_id' => 1,
                'birth_date' => '2008-10-08',
                'email_verified' => false,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
