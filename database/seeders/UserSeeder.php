<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->firstOrFail();
        $userRole = Role::where('name', 'User')->firstOrFail();

        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'role_id' => $adminRole->id,
                'full_name' => 'Sistem Yöneticisi',
                'password' => Hash::make('Admin123!'),
            ]
        );

        User::updateOrCreate(
            ['username' => 'viewer'],
            [
                'role_id' => $userRole->id,
                'full_name' => 'Standart Kullanıcı',
                'password' => Hash::make('User123!'),
            ]
        );
    }
}
