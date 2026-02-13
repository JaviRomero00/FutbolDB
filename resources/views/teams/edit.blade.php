@extends('layouts.app')

@section('title', 'Editar equipo | FutbolDB')

@section('content')
<h1 class="page-title mb-3">Editar equipo</h1>

<div class="card app-card mb-3">
    <div class="card-body">
        <form method="POST" action="{{ route('teams.update', $team->id) }}" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input name="name" value="{{ old('name', $team->name) }}" required class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Liga</label>
                <select name="league_id" class="form-select">
                    <option value="">(Sin liga)</option>
                    @foreach($leagues as $l)
                        <option value="{{ $l->id }}" @selected(old('league_id', $team->league_id) == $l->id)>{{ $l->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('teams.index') }}" class="btn btn-outline-secondary">Volver</a>
            </div>
        </form>
    </div>
</div>

<form method="POST" action="{{ route('teams.destroy', $team->id) }}" onsubmit="return confirm('¿Eliminar equipo?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger">Eliminar equipo</button>
</form>
@endsection
