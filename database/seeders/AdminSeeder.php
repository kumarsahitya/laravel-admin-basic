<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\Admin\User\User::query()->create([
            'first_name' => 'Test',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('Pass@123'),
            'gender' => 'male',
            'phone_number' => fake()->phoneNumber(),
            'email_verified_at' => now()->toDateTimeString(),
        ]);
        $admin->assignRole(config('system.users.admin_role'));

        $admin = \App\Models\Admin\User\User::query()->create([
            'first_name' => 'Test',
            'last_name' => 'Manager',
            'email' => 'manager@example.com',
            'password' => bcrypt('Pass@123'),
            'gender' => 'male',
            'phone_number' => fake()->phoneNumber(),
            'email_verified_at' => now()->toDateTimeString(),
        ]);
        $admin->assignRole('manager');
    }
}
