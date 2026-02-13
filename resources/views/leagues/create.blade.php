@extends('layouts.app')

@section('title', 'Nueva liga | FutbolDB')

@section('content')
<h1 class="page-title mb-3">Nueva liga</h1>

<div class="card app-card">
    <div class="card-body">
        <form method="POST" action="{{ route('leagues.store') }}" class="row g-3">
            @csrf

            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input name="name" value="{{ old('name') }}" required class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">País</label>
                <input name="country" value="{{ old('country') }}" class="form-control">
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('leagues.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
