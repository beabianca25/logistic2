<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'create auction']);
        Permission::create(['name' => 'edit auction']);
        Permission::create(['name' => 'delete auction']);
        Permission::create(['name' => 'view auction']);

        Permission::create(['name' => 'view dashboard']);

        Permission::create(['name' => 'view vendor portal']);
        Permission::create(['name' => 'view vendors']);
        Permission::create(['name' => 'show vendors']);
        Permission::create(['name' => 'edit vendors']);
        Permission::create(['name' => 'delete vendors']);
        Permission::create(['name' => 'manage vendors']);

        Permission::create(['name' => 'view booking']);
        Permission::create(['name' => 'view bookings']);
        Permission::create(['name' => 'show booking']);
        Permission::create(['name' => 'edit booking']);
        Permission::create(['name' => 'delete booking']);
        Permission::create(['name' => 'view user booking']);
        Permission::create(['name' => 'view vendor booking']);

        Permission::create(['name' => 'create booking']);

        Permission::create(['name' => 'view auctions']);
        Permission::create(['name' => 'view bids']);
        Permission::create(['name' => 'view suppliers']);
        Permission::create(['name' => 'view subcontractors']);

        Permission::create(['name' => 'view audit management']);
        Permission::create(['name' => 'view audit supply']);
        Permission::create(['name' => 'view supply report']);
        Permission::create(['name' => 'view audit asset']);
        Permission::create(['name' => 'view asset report']);

        Permission::create(['name' => 'view fleet management']);
        Permission::create(['name' => 'view vehicle']);
        Permission::create(['name' => 'view vehicles']);
        Permission::create(['name' => 'create vehicles']);
        Permission::create(['name' => 'show vehicles']);
        Permission::create(['name' => 'edit vehicles']);
        Permission::create(['name' => 'delete vehicles']);
        Permission::create(['name' => 'view tracking']);
        Permission::create(['name' => 'manage details']);
        Permission::create(['name' => 'view driver']);
        Permission::create(['name' => 'view maintenance']);
        Permission::create(['name' => 'view fuel records']);
        Permission::create(['name' => 'view trip details']);

        Permission::create(['name' => 'view vehicle reservation']);
        Permission::create(['name' => 'view reservation list']);
        Permission::create(['name' => 'view vehicle release']);
        Permission::create(['name' => 'view reservation history']);

        Permission::create(['name' => 'view document tracking']);
        Permission::create(['name' => 'view document submission']);
        Permission::create(['name' => 'view document request']);

        Permission::create(['name' => 'view email']);
        Permission::create(['name' => 'view inbox']);
        Permission::create(['name' => 'compose email']);
        Permission::create(['name' => 'read email']);
        Permission::create(['name' => 'view event calendar']);

        Permission::create(['name' => 'view userdashboard']);

        Permission::create(['name' => 'create event']);
        Permission::create(['name' => 'show bids']);
        Permission::create(['name'=> 'views auctions']);

        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin']);
        $vendorRole = Role::create(['name' => 'vendor']);
        $userRole = Role::create(['name' => 'user']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo(['create role', 'view role', 'update role']);
        $adminRole->givePermissionTo(['create permission', 'view permission']);
        $adminRole->givePermissionTo(['create user', 'view user', 'update user']);
        $adminRole->givePermissionTo(['create product', 'view product', 'update product']);
        $adminRole->givePermissionTo(Permission::all());


        // Let's Create User and assign Role to it.

        $superAdminUser = User::firstOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $superAdminUser->assignRole($superAdminRole);


        $adminUser = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $adminUser->assignRole($adminRole);


        $vendorUser = User::firstOrCreate([
            'email' => 'vendor@gmail.com',
        ], [
            'name' => 'Vendor',
            'email' => 'vendor@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $vendorUser->assignRole($userRole);
    }
}