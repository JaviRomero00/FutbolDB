@extends('layouts.app')

@section('title', 'Inicio | FutbolDB')

@section('content')
<div class="page-hero mb-4">
    <h1>Bienvenido a FutbolDB</h1>
    <p>Consulta clasificaciones, jugadores, equipos y ligas en un solo lugar.</p>
</div>

<div class="quick-actions mb-4">
    <a href="{{ route('players.index') }}" class="btn btn-primary"><span class="btn-icon">👤</span>Ver jugadores</a>
    <a href="{{ route('teams.index') }}" class="btn btn-success"><span class="btn-icon">🛡️</span>Ver equipos</a>
    <a href="{{ route('leagues.index') }}" class="btn btn-info"><span class="btn-icon">🏆</span>Ver ligas</a>
</div>

<div class="card app-card mb-4">
    <div class="card-body">
        <h2 class="section-title">Clasificación por liga</h2>
        @php
            $leagueCatalog = collect($leagues ?? [])
                ->filter(fn ($league) => in_array($league['code'] ?? '', ['PD', 'PL', 'BL1'], true))
                ->map(fn ($league) => [
                    'code' => $league['code'],
                    'name' => $league['name'],
                ])
                ->values();

            if ($leagueCatalog->isEmpty()) {
                $leagueCatalog = collect([
                    ['code' => 'PD', 'name' => 'LaLiga EA Sports'],
                    ['code' => 'PL', 'name' => 'Premier League'],
                    ['code' => 'BL1', 'name' => 'Bundesliga'],
                ]);
            }

            $standingsTable = data_get($standings, 'standings.0.table', []);
            $statusLabels = [
                'SCHEDULED' => 'Programado',
                'TIMED' => 'Programado',
                'IN_PLAY' => 'En juego',
                'PAUSED' => 'Descanso',
                'FINISHED' => 'Finalizado',
                'POSTPONED' => 'Aplazado',
                'CANCELLED' => 'Cancelado',
            ];
        @endphp

        <form action="{{ url('/') }}" method="get" class="row g-2 align-items-center">
            <div class="col-md-6">
                <select name="league_id" class="form-select" onchange="this.form.submit()">
                    @foreach($leagueCatalog as $league)
                        <option value="{{ $league['code'] }}" @selected($leagueId === $league['code'])>
                            {{ $league['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if (isset($standings['error']))
            <div class="alert alert-danger mt-3">{{ $standings['error'] }}</div>
        @elseif (empty($standingsTable))
            <div class="alert alert-warning mt-3 mb-0">No hay clasificación disponible en este momento.</div>
        @else
            <div class="table-responsive mt-3">
                <table class="table table-hover align-middle mb-0 app-table">
                    <thead>
                        <tr>
                            <th>Posición</th>
                            <th>Equipo</th>
                            <th>Puntos</th>
                            <th>Jugados</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($standingsTable as $team)
                            <tr>
                                <td>{{ $team['position'] }}</td>
                                <td>{{ $team['team']['name'] }}</td>
                                <td>{{ $team['points'] }}</td>
                                <td>{{ $team['playedGames'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<div class="card app-card">
    <div class="card-body">
        <h2 class="section-title">Partidos recientes</h2>
        @if (isset($matches['error']))
            <div class="alert alert-warning">{{ $matches['error'] }}</div>
        @elseif (!empty($matches['matches']))
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0 app-table">
                    <thead>
                        <tr>
                            <th>Competición</th>
                            <th>Partido</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matches['matches'] as $match)
                            <tr>
                                <td>{{ $match['competition']['name'] ?? '-' }}</td>
                                <td>{{ $match['homeTeam']['name'] ?? '-' }} vs {{ $match['awayTeam']['name'] ?? '-' }}</td>
                                <td>
                                    @if(!empty($match['utcDate']))
                                        {{ \Carbon\Carbon::parse($match['utcDate'])->timezone(config('app.timezone'))->format('d/m/Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $statusLabels[$match['status'] ?? ''] ?? ($match['status'] ?? '-') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning mb-0">No hay partidos recientes disponibles.</div>
        @endif
    </div>
</div>
@endsection
