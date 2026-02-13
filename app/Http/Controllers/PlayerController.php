<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $searchOperator = DB::connection()->getDriverName() === 'pgsql' ? 'ilike' : 'like';

        $players = DB::table('players')
            ->leftJoin('teams', 'players.team_id', '=', 'teams.id')
            ->leftJoin('leagues', 'players.league_id', '=', 'leagues.id')
            ->select(
                'players.id',
                'players.name',
                'players.age',
                'players.nationality',
                'players.goals',
                'players.assists',
                'teams.name as team_name',
                'leagues.name as league_name'
            )
            ->when($q !== '', function ($query) use ($q, $searchOperator) {
                $query->where('players.name', $searchOperator, "%{$q}%");
            })
            ->orderByDesc('players.goals')
            ->paginate(20);

        return view('players.index', compact('players', 'q'));
    }

    public function show(int $id)
    {
        $player = DB::table('players')
            ->leftJoin('teams', 'players.team_id', '=', 'teams.id')
            ->leftJoin('leagues', 'players.league_id', '=', 'leagues.id')
            ->select(
                'players.*',
                'teams.name as team_name',
                'leagues.name as league_name'
            )
            ->where('players.id', $id)
            ->first();

        abort_if(!$player, 404);

        return view('players.show', compact('player'));
    }

    public function create()
    {
        $teams = DB::table('teams')->select('id', 'name')->orderBy('name')->get();
        $leagues = DB::table('leagues')->select('id', 'name')->orderBy('name')->get();

        return view('players.create', compact('teams', 'leagues'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->playerRules());

        DB::table('players')->insert(array_merge($data, [
            'created_at' => now(),
            'updated_at' => now(),
        ]));

        return redirect()->route('players.index')->with('success', 'Jugador creado.');
    }

    public function edit(int $id)
    {
        $player = DB::table('players')->where('id', $id)->first();
        abort_if(!$player, 404);

        $teams = DB::table('teams')->select('id', 'name')->orderBy('name')->get();
        $leagues = DB::table('leagues')->select('id', 'name')->orderBy('name')->get();

        return view('players.edit', compact('player', 'teams', 'leagues'));
    }

    public function update(Request $request, int $id)
    {
        $player = DB::table('players')->where('id', $id)->first();
        abort_if(!$player, 404);

        $data = $request->validate($this->playerRules());

        DB::table('players')->where('id', $id)->update(array_merge($data, [
            'updated_at' => now(),
        ]));

        return redirect()->route('players.show', $id)->with('success', 'Jugador actualizado.');
    }

    public function destroy(int $id)
    {
        DB::table('players')->where('id', $id)->delete();
        return redirect()->route('players.index')->with('success', 'Jugador eliminado.');
    }

    private function playerRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:14', 'max:60'],
            'height' => ['required', 'numeric', 'min:1.0', 'max:2.5'],
            'nationality' => ['required', 'string', 'max:255'],
            'market_value' => ['required', 'numeric', 'min:0'],
            'matches_played' => ['required', 'integer', 'min:0'],
            'yellow_cards' => ['required', 'integer', 'min:0'],
            'red_cards' => ['required', 'integer', 'min:0'],
            'goals' => ['required', 'integer', 'min:0'],
            'assists' => ['required', 'integer', 'min:0'],
            'team_id' => ['required', 'integer', 'exists:teams,id'],
            'league_id' => ['required', 'integer', 'exists:leagues,id'],
        ];
    }
}
