<?php
// database/seeders/UsersTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Seed admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@texila.com',
            'password' => Hash::make('admin123'), // Change to a secure password
            'phone' => '1234567890',
            'experience' => 10,
            'notice_period' => 30,
            'skills' => 'Admin Skills',
            'job_location' => 'Admin Location',
            'resume' => 'null',
            'photo' => 'null',
            'role' => 'admin', // Set role to admin
        ]);

     
}

}