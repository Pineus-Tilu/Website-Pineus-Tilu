<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            AreaSeeder::class,
            FacilitySeeder::class,
            AreaUnitsSeeder::class,
            PriceSeeder::class,
            CreateAdminUserSeeder::class, // PENTING: Harus sebelum AssignSuperAdminRoleSeeder
            AssignSuperAdminRoleSeeder::class,
        ]);
    }
}