@extends('layouts.app')

@section('title', 'Nuevo foro | FutbolDB')

@section('content')
<h1 class="page-title mb-3">Crear foro</h1>

<div class="card app-card">
    <div class="card-body">
        <form method="POST" action="{{ route('forums.store') }}" class="row g-3">
            @csrf

            <div class="col-12">
                <label class="form-label">Tema</label>
                <input
                    name="topic"
                    value="{{ old('topic') }}"
                    required
                    minlength="5"
                    maxlength="120"
                    class="form-control"
                    placeholder="Ejemplo: ¿Quién ganará la liga este año?"
                >
            </div>

            <div class="col-12">
                <label class="form-label">Contenido</label>
                <textarea
                    name="content"
                    rows="8"
                    required
                    minlength="10"
                    maxlength="5000"
                    class="form-control"
                    placeholder="Escribe aquí tu mensaje..."
                >{{ old('content') }}</textarea>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Publicar</button>
                <a href="{{ route('forums.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
