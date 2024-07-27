<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ShopSeeder::class,
            RoleSeeder::class,
            UserRoleSeeder::class,
        ]);

        $securePassword = Str::random(16);
        $hashedPassword = Hash::make($securePassword);

        $adminRole = Role::where('slug', 'admin')->first();

        if (!$adminRole) {
            $this->command->error('Admin role not found.');
            return;
        }

        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => $hashedPassword,
        ]);

        $user->roles()->attach($adminRole);

        $this->command->info('Admin user created with password: ' . $securePassword);
    }
}
