<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function index()
    {
        $teams = DB::table('teams')
            ->leftJoin('leagues', 'teams.league_id', '=', 'leagues.id')
            ->select('teams.id', 'teams.name', 'teams.league_id', 'leagues.name as league_name')
            ->orderBy('teams.name')
            ->get();

        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        $leagues = DB::table('leagues')->select('id', 'name')->orderBy('name')->get();
        return view('teams.create', compact('leagues'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'league_id' => ['nullable', 'integer', 'exists:leagues,id'],
        ]);

        DB::table('teams')->insert([
            'name' => $data['name'],
            'league_id' => $data['league_id'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('teams.index')->with('success', 'Equipo creado.');
    }

    public function edit(int $id)
    {
        $team = DB::table('teams')->where('id', $id)->first();
        abort_if(!$team, 404);

        $leagues = DB::table('leagues')->select('id', 'name')->orderBy('name')->get();

        return view('teams.edit', compact('team', 'leagues'));
    }

    public function update(Request $request, int $id)
    {
        $team = DB::table('teams')->where('id', $id)->first();
        abort_if(!$team, 404);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'league_id' => ['nullable', 'integer', 'exists:leagues,id'],
        ]);

        DB::table('teams')->where('id', $id)->update([
            'name' => $data['name'],
            'league_id' => $data['league_id'] ?? null,
            'updated_at' => now(),
        ]);

        return redirect()->route('teams.index')->with('success', 'Equipo actualizado.');
    }

    public function destroy(int $id)
    {
        $playersCount = DB::table('players')->where('team_id', $id)->count();

        if ($playersCount > 0) {
            return redirect()
                ->route('teams.index')
                ->with('error', "No se puede eliminar: este equipo tiene {$playersCount} jugadores asociados.");
        }

        DB::table('teams')->where('id', $id)->delete();

        return redirect()->route('teams.index')->with('success', 'Equipo eliminado.');
    }
}
