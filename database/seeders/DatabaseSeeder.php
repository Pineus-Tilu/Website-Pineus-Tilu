<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Test user
        User::where('email', 'test@example.com')->delete();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            AreaSeeder::class,
            FacilitySeeder::class,
            AreaUnitsSeeder::class,
            PriceSeeder::class,
            CreateAdminUserSeeder::class, // PENTING: Harus sebelum AssignSuperAdminRoleSeeder
            AssignSuperAdminRoleSeeder::class,
        ]);
    }
}