<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignSuperAdminRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Ganti email berikut dengan email user admin Anda
        $adminEmail = 'adminpineustilu@gmail.com';

        // Cari user admin
        $user = User::where('email', $adminEmail)->first();

        // Pastikan role Super Admin sudah ada
        $role = Role::firstOrCreate(
            ['name' => 'Super Admin', 'guard_name' => 'web']
        );

        if ($user && !$user->hasRole('Super Admin')) {
            $user->assignRole($role);
            $this->command->info("Role Super Admin berhasil diberikan ke {$user->email}");
        } else if (!$user) {
            $this->command->warn("User dengan email {$adminEmail} tidak ditemukan.");
        } else {
            $this->command->info("User {$user->email} sudah memiliki role Super Admin.");
        }
    }
}