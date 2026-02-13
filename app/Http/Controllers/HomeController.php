<?php

namespace App\Http\Controllers;

use App\Services\FootballService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(private readonly FootballService $footballService) {}

    public function index(Request $request)
    {
        $leagues = $this->footballService->getLeagues();
        $leagueId = $request->input('league_id', 'PD');
        $standings = $this->footballService->getStandings($leagueId);
        $matches = $this->footballService->getMatches();

        return view('home', compact('standings', 'leagues', 'leagueId', 'matches'));
    }
}
