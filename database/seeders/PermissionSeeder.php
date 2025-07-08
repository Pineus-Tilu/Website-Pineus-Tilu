<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{   
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ✅ CLEAR CACHE PERMISSION DULU
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ✅ BUAT PERMISSIONS YANG DIPERLUKAN
        $permissions = [
            'view_dashboard',
            'manage_users',
            'manage_bookings',
            'manage_areas',
            'manage_galleries', 
            'view_reports',
            'create_bookings',
            'edit_bookings',
            'delete_bookings',
        ];

        // Buat semua permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // ✅ DEFINISIKAN ROLE DAN PERMISSIONS
        $rolePermissions = [
            'Super Admin' => [
                'view_dashboard',
                'manage_users', 
                'manage_bookings',
                'manage_areas',
                'manage_galleries',
                'view_reports',
                'create_bookings',
                'edit_bookings',
                'delete_bookings',
            ],
            'User' => [ // ✅ KASIH PERMISSION BASIC UNTUK USER
                'view_dashboard',
                'create_bookings',
            ],
        ];

        // ✅ BUAT ROLE DAN ASSIGN PERMISSIONS
        foreach ($rolePermissions as $roleName => $permissionList) {
            echo "Creating role: {$roleName}\n";
            
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
            
            $role->syncPermissions($permissionList);
            
            echo "✅ Role '{$roleName}' created with " . count($permissionList) . " permissions.\n";
        }

        // ✅ ASSIGN ROLE 'USER' KE SEMUA USER YANG BELUM PUNYA ROLE
        $usersWithoutRoles = User::doesntHave('roles')->get();
        foreach ($usersWithoutRoles as $user) {
            $user->assignRole('User');
            echo "✅ Assigned 'User' role to: {$user->email}\n";
        }

        echo "\n🎉 All roles and permissions seeded successfully!\n";
        echo "📊 Total roles: " . Role::count() . "\n";
        echo "📋 Total permissions: " . Permission::count() . "\n";
        echo "👥 Total users with roles: " . User::has('roles')->count() . "\n";
        
        // Clear cache
        Artisan::call('cache:clear');
        Artisan::call('permission:cache-reset');
    }
}