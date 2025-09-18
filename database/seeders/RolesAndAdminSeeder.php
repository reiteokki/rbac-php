<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        $super = Role::firstOrCreate(['name' => 'super'], ['label' => 'Super User']);
        $viewer = Role::firstOrCreate(['name' => 'viewer'], ['label' => 'Viewer']);

        User::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'role_id' => $super->id,
            ]
        );
    }
}
