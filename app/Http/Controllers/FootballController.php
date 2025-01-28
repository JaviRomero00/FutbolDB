<?php

namespace App\Http\Controllers;

use App\Services\FootballService;
use Illuminate\Http\Request;

class FootballController extends Controller
{
    protected $footballService;

    public function __construct(FootballService $footballService)
    {
        $this->footballService = $footballService;
    }

    public function index()
    {
        // Obtener los partidos de la API
        $matches = $this->footballService->getMatches();

        // Pasar los datos a una vista
        return view('football.index', compact('matches'));
    }
}
