<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SuperAdmin = Role::create([
            'name' => 'super admin',
            'guard_name' => 'web'
        ]);

        $Owner = Role::create([
            'name' => 'owner',
            'guard_name' => 'web'
        ]);

        $Admin = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $Manager = Role::create([
            'name' => 'manager',
            'guard_name' => 'web'
        ]);

        $Operator = Role::create([
            'name' => 'operator',
            'guard_name' => 'web'
        ]);

        $Akuntan = Role::create([
            'name' => 'akuntan',
            'guard_name' => 'web'
        ]);
    }
}
