<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Manager']);
        $role1->givePermissionTo('view users');

        $role2 = Role::create(['name' => 'Super Admin']);
        $role2->givePermissionTo('view users');
        $role2->givePermissionTo('create users');
        $role2->givePermissionTo('edit users');
        $role2->givePermissionTo('delete users');
        $role2->givePermissionTo('view role');
        $role2->givePermissionTo('create role');
        $role2->givePermissionTo('edit role');
        $role2->givePermissionTo('delete role');

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@thunder.id',
            'username' => 'super_admin',
            'password' => '$2y$10$ZM/m/VsM1xaszCdh3mUOyu7.QoC3zV4cb8RZQS2X.1j26slVeDhd6'
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@thunder.id',
            'username' => 'manager',
            'password' => '$2y$10$ZM/m/VsM1xaszCdh3mUOyu7.QoC3zV4cb8RZQS2X.1j26slVeDhd6'
        ]);
        $user->assignRole($role1);

    }
}
