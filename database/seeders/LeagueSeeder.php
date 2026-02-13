<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeagueSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('leagues')->upsert([
            ['name' => 'LaLiga', 'country' => 'España', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Premier League', 'country' => 'Inglaterra', 'created_at' => now(), 'updated_at' => now()],
        ], ['name'], ['country', 'updated_at']);
    }
}
