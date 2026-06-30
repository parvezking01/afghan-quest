<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'مدیر سیستم',
            'email' => 'admin@afghanquest.com',
            'password' => Hash::make('password'),
            'phone' => '+93700000001',
            'whatsapp' => '+93700000001',
            'role' => 'admin',
            'is_approved' => true,
            'is_active' => true,
        ]);
    }
}
