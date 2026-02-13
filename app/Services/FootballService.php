<?php

namespace App\Services;

use Throwable;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class FootballService
{
    private const COMPETITIONS_API_URL = 'https://api.football-data.org/v4/competitions';
    private const MATCHES_API_URL = 'https://api.football-data.org/v4/matches';

    private ?string $apiKey;

    public function __construct()
    {
        $key = env('FOOTBALL_API_KEY');
        $this->apiKey = is_string($key) && trim($key) !== '' ? trim($key) : null;
    }

    private function client(): PendingRequest
    {
        return Http::acceptJson()
            ->timeout(10)
            ->retry(2, 200)
            ->withHeaders([
                'X-Auth-Token' => $this->apiKey ?? '',
            ]);
    }

    public function getMatches(): array
    {
        if (!$this->apiKey) {
            return ['error' => 'FOOTBALL_API_KEY no configurada'];
        }

        try {
            $response = $this->client()->get(self::MATCHES_API_URL, [
                'limit' => 10,
            ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (Throwable) {
            // Evita que una caída de la API externa provoque un error 500.
        }

        return [
            'error' => 'No se pudieron obtener los partidos',
        ];
    }

    public function getStandings(string $competitionId): array
    {
        if (!$this->apiKey) {
            return ['error' => 'FOOTBALL_API_KEY no configurada'];
        }

        try {
            $response = $this->client()->get(self::COMPETITIONS_API_URL."/{$competitionId}/standings");

            if ($response->successful()) {
                return $response->json();
            }
        } catch (Throwable) {
            // Devuelve un error controlado cuando la API externa no está disponible.
        }

        return [
            'error' => 'No se pudieron obtener los datos de la clasificación',
        ];
    }

    public function getLeagues(): array
    {
        if (!$this->apiKey) {
            return [];
        }

        try {
            $response = $this->client()->get(self::COMPETITIONS_API_URL);

            if ($response->successful()) {
                $json = $response->json();

                return $json['competitions'] ?? [];
            }
        } catch (Throwable) {
            // En fallo de red/API, devuelve una lista vacía para evitar 500 en la vista.
        }

        return [];
    }
}
