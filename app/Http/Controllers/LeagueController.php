<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeagueController extends Controller
{
    public function index()
    {
        $leagues = DB::table('leagues')
            ->select('id', 'name', 'country')
            ->orderBy('name')
            ->get();

        return view('leagues.index', compact('leagues'));
    }

    public function create()
    {
        return view('leagues.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);

        DB::table('leagues')->insert([
            'name' => $data['name'],
            'country' => $data['country'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('leagues.index')->with('success', 'Liga creada correctamente.');
    }

    public function edit(int $id)
    {
        $league = DB::table('leagues')->where('id', $id)->first();
        abort_if(!$league, 404);

        return view('leagues.edit', compact('league'));
    }

    public function update(Request $request, int $id)
    {
        $league = DB::table('leagues')->where('id', $id)->first();
        abort_if(!$league, 404);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);

        DB::table('leagues')->where('id', $id)->update([
            'name' => $data['name'],
            'country' => $data['country'] ?? null,
            'updated_at' => now(),
        ]);

        return redirect()->route('leagues.index')->with('success', 'Liga actualizada correctamente.');
    }

    public function destroy(int $id)
    {
        $teamsCount = DB::table('teams')->where('league_id', $id)->count();

        if ($teamsCount > 0) {
            return redirect()
                ->route('leagues.index')
                ->with('error', "No se puede eliminar: esta liga tiene {$teamsCount} equipos asociados.");
        }

        DB::table('leagues')->where('id', $id)->delete();

        return redirect()->route('leagues.index')->with('success', 'Liga eliminada.');
    }
}
