@extends('layouts.app')

@section('title', $player->name . ' | FutbolDB')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h1 class="page-title mb-0">{{ $player->name }}</h1>
    <div>
        <a href="{{ route('players.index') }}" class="btn btn-outline-secondary">Volver</a>
        @if (Route::has('players.edit'))
            <a href="{{ route('players.edit', $player->id) }}" class="btn btn-primary">Editar</a>
        @endif
    </div>
</div>

<div class="card app-card">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6"><strong>Equipo:</strong> {{ $player->team_name ?? '-' }}</div>
            <div class="col-md-6"><strong>Liga:</strong> {{ $player->league_name ?? '-' }}</div>
            <div class="col-md-6"><strong>Edad:</strong> {{ $player->age }}</div>
            <div class="col-md-6"><strong>Altura:</strong> {{ $player->height }}</div>
            <div class="col-md-6"><strong>Nacionalidad:</strong> {{ $player->nationality }}</div>
            <div class="col-md-6"><strong>Valor mercado:</strong> {{ $player->market_value }}</div>
            <div class="col-md-6"><strong>Partidos:</strong> {{ $player->matches_played }}</div>
            <div class="col-md-6"><strong>Goles:</strong> {{ $player->goals }}</div>
            <div class="col-md-6"><strong>Asistencias:</strong> {{ $player->assists }}</div>
            <div class="col-md-6"><strong>Amarillas:</strong> {{ $player->yellow_cards }}</div>
            <div class="col-md-6"><strong>Rojas:</strong> {{ $player->red_cards }}</div>
        </div>
    </div>
</div>
@endsection
