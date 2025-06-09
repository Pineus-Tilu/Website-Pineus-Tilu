<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;

class PermissionSeeder extends Seeder
{

    
    /**
     * Run the database seeds.
     */
    public function run(): void
    
    {
        $permission['Super Admin'] = [];
        $permission['User'] = [];

        foreach ($permission as $key => $value) {
            foreach ($value as $p) {
                Permission::findOrCreate($p, 'web');
            }
            $role = Role::findOrCreate($key, 'web');
            $role->syncPermissions($value);
        }

        $role = Role::findOrCreate('Super Admin', 'web');
        $role->syncPermissions($permission['Super Admin']);

        Artisan::call('cache:clear');
    }
}
