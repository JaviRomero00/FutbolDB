<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'q' => ['required', 'string', 'min:2', 'max:100'],
        ]);

        $query = trim($validated['q']);

        $players = Player::query()
            ->where('name', 'like', "%{$query}%")
            ->orderBy('name')
            ->limit(10)
            ->get();

        $teams = Team::query()
            ->where('name', 'like', "%{$query}%")
            ->orderBy('name')
            ->limit(10)
            ->get();

        $leagues = League::query()
            ->where('name', 'like', "%{$query}%")
            ->orderBy('name')
            ->limit(10)
            ->get();

        return view('search.index', compact('query', 'players', 'teams', 'leagues'));
    }
}
