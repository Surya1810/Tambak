<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'name' => 'Super Admin',
            'username' => 'Super Admin',
            'email' => 'Super@example.com',
            'phone' => '89512776878',
            'password' => bcrypt('123'),
        ]);
        $superadmin->assignRole('super admin');

        $owner = User::create([
            'name' => 'Owner',
            'username' => 'Owner',
            'email' => 'Owner@example.com',
            'phone' => '89512776878',
            'password' => bcrypt('password')
        ]);
        $owner->assignRole('owner');

        $owner2 = User::create([
            'name' => 'Owner2',
            'username' => 'Owner2',
            'email' => 'Owner2@example.com',
            'phone' => '89512776878',
            'password' => bcrypt('password')
        ]);
        $owner2->assignRole('owner');

        $admin = User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'Admin@example.com',
            'phone' => '89512776878',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        $operator = User::create([
            'name' => 'Operator',
            'username' => 'Operator',
            'email' => 'Operator@example.com',
            'phone' => '89512776878',
            'phone' => '89512776878',
            'password' => bcrypt('password')
        ]);
        $operator->assignRole('operator');
    }
}
