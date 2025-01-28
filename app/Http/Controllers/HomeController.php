<?php

namespace App\Http\Controllers;

use App\Services\FootballService2;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $footballService2;

    public function __construct(FootballService2 $footballService2)
    {
        $this->footballService2 = $footballService2;
    }

    public function index(Request $request)
    {
        // Obtener la lista de ligas disponibles
        $leagues = $this->footballService2->getLeagues();

        // Establecer la liga por defecto (Liga Española)
        $defaultLeagueId = 'PD'; // ID de la liga española (LaLiga)

        // Obtener la liga seleccionada o la liga por defecto
        $leagueId = $request->input('league_id', $defaultLeagueId);

        // Obtener la clasificación de la liga seleccionada
        $standings = $this->footballService2->getStandings($leagueId);

        // Pasar las variables a la vista
        return view('home', compact('standings', 'leagues', 'leagueId'));
    }
}
