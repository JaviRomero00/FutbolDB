@extends('layouts.app')

@section('title', 'Nuevo jugador | FutbolDB')

@section('content')
<h1 class="page-title mb-3">Nuevo jugador</h1>

<div class="card app-card">
    <div class="card-body">
        <form method="POST" action="{{ route('players.store') }}" class="row g-3">
            @csrf

            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input name="name" value="{{ old('name') }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Edad</label>
                <input type="number" name="age" value="{{ old('age', 25) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Altura (m)</label>
                <input type="number" step="0.01" name="height" value="{{ old('height', 1.80) }}" required class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Nacionalidad</label>
                <input name="nationality" value="{{ old('nationality', 'España') }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Valor de mercado</label>
                <input type="number" step="0.01" name="market_value" value="{{ old('market_value', 0) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Partidos</label>
                <input type="number" name="matches_played" value="{{ old('matches_played', 0) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Goles</label>
                <input type="number" name="goals" value="{{ old('goals', 0) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Asistencias</label>
                <input type="number" name="assists" value="{{ old('assists', 0) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Amarillas</label>
                <input type="number" name="yellow_cards" value="{{ old('yellow_cards', 0) }}" required class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label">Rojas</label>
                <input type="number" name="red_cards" value="{{ old('red_cards', 0) }}" required class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Equipo</label>
                <select name="team_id" required class="form-select">
                    <option value="">Selecciona equipo...</option>
                    @foreach($teams as $t)
                        <option value="{{ $t->id }}" @selected(old('team_id') == $t->id)>{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Liga</label>
                <select name="league_id" required class="form-select">
                    <option value="">Selecciona liga...</option>
                    @foreach($leagues as $l)
                        <option value="{{ $l->id }}" @selected(old('league_id') == $l->id)>{{ $l->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('players.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
