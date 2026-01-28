<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminExists = User::where('email', 'admin@usm.ac.id')->first();
        
        if (!$adminExists) {
            User::create([
                'name' => 'Admin International Office',
                'email' => 'admin@usm.ac.id',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now()
            ]);

            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@usm.ac.id');
            $this->command->info('Password: password123');
        } else {
            $this->command->info('Admin user already exists!');
        }
    }
}