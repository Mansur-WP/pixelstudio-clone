<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PlatformAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'platform@admin'],
            [
                'name' => 'Platform Admin',
                'email' => 'platform@admin',
                'password' => Hash::make('platform123'),
                'role' => 'platform',
                'studio_id' => null,
                'is_active' => true,
            ]
        );
    }
}
