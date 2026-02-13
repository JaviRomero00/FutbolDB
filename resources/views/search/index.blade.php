@extends('layouts.app')

@section('title', 'Resultados de búsqueda')

@section('content')
    <div class="page-hero mb-4">
        <h1 class="page-title">Resultados de búsqueda</h1>
        <p>Consulta global para jugadores, equipos y ligas.</p>
    </div>

    <div class="mb-4">
        <p class="mb-0">
            Búsqueda: <strong>"{{ $query }}"</strong>
        </p>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="app-card p-3 h-100">
                <h2 class="section-title mb-3">Jugadores</h2>
                @if($players->isEmpty())
                    <p class="text-muted mb-0">No hay coincidencias.</p>
                @else
                    <ul class="list-unstyled mb-0">
                        @foreach($players as $player)
                            <li class="mb-2">
                                <a href="{{ route('players.show', $player->id) }}">{{ $player->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="app-card p-3 h-100">
                <h2 class="section-title mb-3">Equipos</h2>
                @if($teams->isEmpty())
                    <p class="text-muted mb-0">No hay coincidencias.</p>
                @else
                    <ul class="list-unstyled mb-0">
                        @foreach($teams as $team)
                            <li class="mb-2">{{ $team->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="app-card p-3 h-100">
                <h2 class="section-title mb-3">Ligas</h2>
                @if($leagues->isEmpty())
                    <p class="text-muted mb-0">No hay coincidencias.</p>
                @else
                    <ul class="list-unstyled mb-0">
                        @foreach($leagues as $league)
                            <li class="mb-2">{{ $league->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
