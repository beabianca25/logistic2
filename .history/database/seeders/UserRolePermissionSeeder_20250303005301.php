<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User; // Ensure you're using the correct User model namespace

class UserRolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define Permissions
        $permissions = [
            'view role', 'create role', 'update role', 'delete role',
            'view permission', 'create permission', 'update permission', 'delete permission',
            'view user', 'create user', 'update user', 'delete user',
            'view product', 'create product', 'update product', 'delete product'
        ];

        // Check if permission exists before creating
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission, 'guard_name' => 'web']);
            }
        }

        // Create Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $staffRole = Role::firstOrCreate(['name' => 'vendor']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Assign all permissions to super-admin
        $superAdminRole->syncPermissions(Permission::all());

        // Assign specific permissions to admin
        $adminPermissions = [
            'create role', 'view role', 'update role',
            'create permission', 'view permission',
            'create user', 'view user', 'update user',
            'create product', 'view product', 'update product'
        ];
        $adminRole->syncPermissions($adminPermissions);

        // Create Users and Assign Roles
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'role' => $superAdminRole
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => $adminRole
            ],
            [
                'name' => 'Vendor',
                'email' => 'vendor@gmail.com',
                'role' => $staffRole
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('12345678'),
                ]
            );
            $user->assignRole($userData['role']);
        }
    }
}
