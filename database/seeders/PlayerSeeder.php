<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        $teams = DB::table('teams')->select('id', 'league_id')->get();
        $teamIds = $teams->pluck('id');

        // Evita que se dupliquen jugadores en cada ejecución de seed.
        DB::table('players')->whereIn('team_id', $teamIds)->delete();

        $nationalities = ['España', 'Argentina', 'Brasil', 'Francia', 'Portugal', 'Italia', 'Alemania', 'Inglaterra', 'Países Bajos', 'Uruguay'];

        $players = [];

        foreach ($teams as $team) {
            for ($i = 0; $i < 18; $i++) {
                $matches = random_int(0, 38);

                $players[] = [
                    'name' => Str::title(fake()->firstName().' '.fake()->lastName()),
                    'age' => random_int(17, 36),
                    'height' => round(random_int(165, 200) / 100, 2),
                    'nationality' => $nationalities[array_rand($nationalities)],
                    'market_value' => round(random_int(50, 1200) / 10, 1),
                    'matches_played' => $matches,
                    'yellow_cards' => random_int(0, 10),
                    'red_cards' => random_int(0, 2),
                    'goals' => min(random_int(0, 25), $matches),
                    'assists' => min(random_int(0, 15), $matches),
                    'team_id' => $team->id,
                    'league_id' => $team->league_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        foreach (array_chunk($players, 500) as $chunk) {
            DB::table('players')->insert($chunk);
        }
    }
}
