<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FootballService2
{
    protected $apiUrl = 'https://api.football-data.org/v4/competitions';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('FOOTBALL_API_KEY');
    }

    /**
     * Obtener la clasificación de una liga.
     *
     * @param string $competitionId
     * @return array
     */
    public function getStandings($competitionId)
    {
        $response = Http::withHeaders([
            'X-Auth-Token' => $this->apiKey
        ])->get("{$this->apiUrl}/{$competitionId}/standings");

        if ($response->successful()) {
            return $response->json();
        }

        return [
            'error' => 'No se pudieron obtener los datos de la clasificación'
        ];
    }

    /**
     * Obtener la lista de ligas disponibles.
     *
     * @return array
     */
    public function getLeagues()
    {
        $response = Http::withHeaders([
            'X-Auth-Token' => $this->apiKey
        ])->get($this->apiUrl);

        if ($response->successful()) {
            return $response->json()['competitions']; // Devuelve las ligas disponibles
        }

        return [];
    }
}
