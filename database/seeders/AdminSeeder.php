<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'address' => '187A Colombo Road, Negombo',
            'contact_no' => '0771234567',
            'dob' => '1990-01-01',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ])->assignRole('admin');
    }
}
