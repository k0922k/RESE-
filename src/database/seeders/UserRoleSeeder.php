<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $representativeRole = Role::where('slug', 'representative')->first();
        $userRole = Role::where('slug', 'user')->first();

        if (!$adminRole || !$representativeRole || !$userRole) {
            $this->command->error('One or more roles are missing.');
            return;
        }

        $users = [
            [
                'name' => '管理者',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => $adminRole,
            ],
            [
                'name' => '店舗代表者',
                'email' => 'representative@example.com',
                'password' => Hash::make('password'),
                'role' => $representativeRole,
            ],
            [
                'name' => '利用者',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role' => $userRole,
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                ['name' => $userData['name'], 'password' => $userData['password']]
            );

            if (!$user->roles->contains($userData['role']->id)) {
                $user->roles()->attach($userData['role']);
            }
        }
    }
}
