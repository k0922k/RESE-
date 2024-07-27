<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 役割データの挿入（重複を避けるために exists() を使用）
        $roles = [
            ['name' => '管理者', 'slug' => 'admin'],
            ['name' => '店舗代表者', 'slug' => 'representative'],
            ['name' => '利用者', 'slug' => 'user'],
        ];

        foreach ($roles as $roleData) {
            if (!Role::where('name', $roleData['name'])->exists()) {
                Role::create($roleData);
            }
        }
    }
}
