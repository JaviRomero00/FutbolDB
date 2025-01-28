<?php

// app/Http/Controllers/PlayerController.php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::with(['team', 'league'])->get();
        return view('players.index', compact('players'));
    }

    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }
}
