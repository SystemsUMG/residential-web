<?php

namespace Database\Seeders;

use App\Enums\UserType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for tickets
        Permission::create(['name' => 'view tickets']);
        Permission::create(['name' => 'create tickets']);
        Permission::create(['name' => 'edit tickets']);
        Permission::create(['name' => 'delete tickets']);
        Permission::create(['name' => 'status tickets']);

        // Create permissions for penalties
        Permission::create(['name' => 'view penalties']);
        Permission::create(['name' => 'create penalties']);
        Permission::create(['name' => 'edit penalties']);
        Permission::create(['name' => 'delete penalties']);
        Permission::create(['name' => 'status penalties']);

        // Create permissions for dashboard
        Permission::create(['name' => 'view dashboard']);

        // Create permissions for users
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // Create permissions for penalty categories
        Permission::create(['name' => 'view penalty categories']);
        Permission::create(['name' => 'create penalty categories']);
        Permission::create(['name' => 'edit penalty categories']);
        Permission::create(['name' => 'delete penalty categories']);

        // Create permissions for ticket categories
        Permission::create(['name' => 'view ticket categories']);
        Permission::create(['name' => 'create ticket categories']);
        Permission::create(['name' => 'edit ticket categories']);
        Permission::create(['name' => 'delete ticket categories']);

        // Create permissions for houses
        Permission::create(['name' => 'view houses']);
        Permission::create(['name' => 'create houses']);
        Permission::create(['name' => 'edit houses']);
        Permission::create(['name' => 'delete houses']);

        $operatorPermissions = Permission::whereIn('name', [
            'view tickets',
            'edit tickets',
            'delete tickets',
            'status tickets',
        ])->get();
        $operatorRole = Role::create(['name' => UserType::Operador]);
        $operatorRole->givePermissionTo($operatorPermissions);

        $guardPermissions = Permission::whereIn('name', [
            'view penalties',
            'create penalties',
            'edit penalties',
            'delete penalties',
        ])->get();
        $guardRole = Role::create(['name' => UserType::Guardia]);
        $guardRole->givePermissionTo($guardPermissions);

        $residentPermissions = Permission::whereIn('name', [
            'view penalties',
            'view tickets',
            'create tickets',
            'edit tickets',
        ])->get();
        $residentRole = Role::create(['name' => UserType::Residente]);
        $residentRole->givePermissionTo($residentPermissions);

        $adminPermissions = Permission::all();
        $adminRole = Role::create(['name' => UserType::Admin]);
        $adminRole->givePermissionTo($adminPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        $user?->assignRole($adminRole);
    }
}
