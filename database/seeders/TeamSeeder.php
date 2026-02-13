<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $laligaId = DB::table('leagues')->where('name', 'LaLiga')->value('id');
        $premierId = DB::table('leagues')->where('name', 'Premier League')->value('id');

        $laligaTeams = [
            'Real Madrid', 'FC Barcelona', 'Atlético de Madrid', 'Sevilla',
            'Real Sociedad', 'Villarreal', 'Valencia', 'Athletic Club',
            'Real Betis', 'Celta de Vigo',
        ];

        $premierTeams = [
            'Manchester City', 'Liverpool', 'Arsenal', 'Manchester United',
            'Chelsea', 'Tottenham', 'Newcastle', 'Aston Villa',
            'Brighton', 'West Ham',
        ];

        $rows = [];

        foreach ($laligaTeams as $name) {
            $rows[] = ['name' => $name, 'league_id' => $laligaId, 'created_at' => now(), 'updated_at' => now()];
        }

        foreach ($premierTeams as $name) {
            $rows[] = ['name' => $name, 'league_id' => $premierId, 'created_at' => now(), 'updated_at' => now()];
        }

        DB::table('teams')->upsert($rows, ['name', 'league_id'], ['updated_at']);
    }
}
