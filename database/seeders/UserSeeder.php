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
        $admin = User::create([
            'role_id' => '1',
            'position_id' => '1',
            'department_id' => '1',
            'name' => 'Super Admin',
            'username' => 'Super Admin',
            'email' => 'super@example.com',
            'password' => bcrypt('123'),
            'level' => '1'
        ]);
    }
}
