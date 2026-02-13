@extends('layouts.app')

@section('title', 'Editar jugador | FutbolDB')

@section('content')
<h1 class="page-title mb-3">Editar jugador</h1>

<div class="card app-card mb-3">
    <div class="card-body">
        <form method="POST" action="{{ route('players.update', $player->id) }}" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input name="name" value="{{ old('name', $player->name) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Edad</label>
                <input type="number" name="age" value="{{ old('age', $player->age) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Altura (m)</label>
                <input type="number" step="0.01" name="height" value="{{ old('height', $player->height) }}" required class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Nacionalidad</label>
                <input name="nationality" value="{{ old('nationality', $player->nationality) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Valor de mercado</label>
                <input type="number" step="0.01" name="market_value" value="{{ old('market_value', $player->market_value) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Partidos</label>
                <input type="number" name="matches_played" value="{{ old('matches_played', $player->matches_played) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Goles</label>
                <input type="number" name="goals" value="{{ old('goals', $player->goals) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Asistencias</label>
                <input type="number" name="assists" value="{{ old('assists', $player->assists) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Amarillas</label>
                <input type="number" name="yellow_cards" value="{{ old('yellow_cards', $player->yellow_cards) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Rojas</label>
                <input type="number" name="red_cards" value="{{ old('red_cards', $player->red_cards) }}" required class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Equipo</label>
                <select name="team_id" required class="form-select">
                    @foreach($teams as $t)
                        <option value="{{ $t->id }}" @selected(old('team_id', $player->team_id) == $t->id)>{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Liga</label>
                <select name="league_id" required class="form-select">
                    @foreach($leagues as $l)
                        <option value="{{ $l->id }}" @selected(old('league_id', $player->league_id) == $l->id)>{{ $l->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('players.show', $player->id) }}" class="btn btn-outline-secondary">Volver</a>
            </div>
        </form>
    </div>
</div>

<form method="POST" action="{{ route('players.destroy', $player->id) }}" onsubmit="return confirm('¿Eliminar jugador?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger">Eliminar jugador</button>
</form>
@endsection
