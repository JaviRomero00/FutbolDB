@extends('layouts.app')

@section('title', 'Editar liga | FutbolDB')

@section('content')
<h1 class="page-title mb-3">Editar liga</h1>

<div class="card app-card mb-3">
    <div class="card-body">
        <form method="POST" action="{{ route('leagues.update', $league->id) }}" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input name="name" value="{{ old('name', $league->name) }}" required class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">País</label>
                <input name="country" value="{{ old('country', $league->country) }}" class="form-control">
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('leagues.index') }}" class="btn btn-outline-secondary">Volver</a>
            </div>
        </form>
    </div>
</div>

<form method="POST" action="{{ route('leagues.destroy', $league->id) }}" onsubmit="return confirm('¿Seguro que quieres eliminar esta liga?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger">Eliminar liga</button>
</form>
@endsection
