<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DemoStudioSeeder extends Seeder
{
    public function run(): void
    {
        $studio = Studio::updateOrCreate(
            ['slug' => 'demo-studio'],
            [
                'name' => 'Demo Studio',
                'slug' => 'demo-studio',
                'plan' => 'free',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@demo'],
            [
                'name' => 'Studio Admin',
                'email' => 'admin@demo',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'studio_id' => $studio->id,
                'is_active' => true,
            ]
        );
    }
}
