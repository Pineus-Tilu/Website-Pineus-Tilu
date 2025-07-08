<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus user admin jika sudah ada (untuk mencegah duplikasi)
        User::where('email', 'adminpineustilu@gmail.com')->delete();
        
        // Buat user admin baru
        $user = User::create([
            'name' => 'Admin Pineus Tilu',
            'email' => 'adminpineustilu@gmail.com',
            'password' => Hash::make('adminpineustilu'),
            'email_verified_at' => now(),
        ])->assignRole('Super Admin'); // Assign role Super Admin

        $this->command->info("User admin berhasil dibuat: {$user->email}");
    }
}