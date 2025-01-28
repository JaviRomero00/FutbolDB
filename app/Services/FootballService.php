<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FootballService
{
    protected $apiUrl = 'https://api.football-data.org/v4/matches';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('FOOTBALL_API_KEY');
    }

    /**
     * Obtener los partidos.
     *
     * @return array
     */
    public function getMatches()
    {
        $response = Http::withHeaders([
            'X-Auth-Token' => $this->apiKey
        ])->get($this->apiUrl, [
            'limit' => 10,  // Limitar los resultados a 10 partidos
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return [
            'error' => 'No se pudieron obtener los partidos'
        ];
    }
}
