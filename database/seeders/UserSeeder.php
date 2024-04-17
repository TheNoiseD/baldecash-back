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
        $userAdmin = [
            'name' => 'admin',
            'lastname' => 'admin',
            'role_id' => 1, // 'admin' role
            'email' => 'admin@admin.test',
            'password' => 'admin',
        ];
        User::factory()->create($userAdmin);
//        crear 100 usuarios
        User::factory()->count(99)->create();
    }
}
