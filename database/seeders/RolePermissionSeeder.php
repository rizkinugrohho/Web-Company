<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage statistics',
            'manage products',
            'manage principles',
            'manage testimonials',
            'manage clients',
            'manage teams',
            'manage abouts',
            'manage appointments',
            'manage hero section',
        ];
        foreach($permissions as $permission){
            Permission::firstOrCreate(
                [
                    'name' => $permission
                ]
                );
        }

        //Super Admin Role
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);
        $user = User::create([
            'name' => 'Rizki',
            'email' => 'super@admin.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($superAdminRole);

        //Admin Role
        $adminRole = Role::firstOrCreate([
            'name' => 'admin'
        ]);
        $adminPermissions = [
            'manage products',
            'manage appointments',
            'manage principles',
        ];
        $adminRole->syncPermissions($adminPermissions);
    }
}
