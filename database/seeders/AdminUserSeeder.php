<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // First, try to find existing admin user by email or username
        $admin = User::where('email', 'info@itappdigital.com')
            ->orWhere('username', 'admin')
            ->orWhere('is_admin', true)
            ->first();

        if ($admin) {
            // Update existing admin user
            $admin->update([
                'name' => 'Admin User',
                'email' => 'info@itappdigital.com',
                'password' => Hash::make('w7j&Q@B9|'),
                'username' => 'admin',
                'status' => 'active',
                'is_admin' => true
            ]);
        } else {
            // Create new admin user
            User::create([
                'name' => 'Admin User',
                'email' => 'info@itappdigital.com',
                'password' => Hash::make('w7j&Q@B9|'),
                'username' => 'admin',
                'status' => 'active',
                'is_admin' => true
            ]);
        }
    }
}
