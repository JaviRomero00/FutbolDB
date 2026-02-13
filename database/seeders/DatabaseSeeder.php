<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'javi@futboldb.com'],
            [
                'name' => 'Javi',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            LeagueSeeder::class,
            TeamSeeder::class,
            PlayerSeeder::class,
            FooterSettingsSeeder::class,
        ]);
    }
}
