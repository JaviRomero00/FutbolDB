@extends('layouts.app')

@section('title', 'Nuevo equipo | FutbolDB')

@section('content')
<h1 class="page-title mb-3">Nuevo equipo</h1>

<div class="card app-card">
    <div class="card-body">
        <form method="POST" action="{{ route('teams.store') }}" class="row g-3">
            @csrf

            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input name="name" value="{{ old('name') }}" required class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Liga</label>
                <select name="league_id" class="form-select">
                    <option value="">(Sin liga)</option>
                    @foreach($leagues as $l)
                        <option value="{{ $l->id }}" @selected(old('league_id') == $l->id)>{{ $l->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('teams.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
