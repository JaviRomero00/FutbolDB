@extends('layouts.app')

@section('title', 'Contacto | FutbolDB')

@section('content')
<div class="page-hero mb-4">
    <h1 class="page-title">Contacto</h1>
    <p>Si detectas un fallo o quieres enviar una sugerencia, rellena este formulario.</p>
</div>

<div class="card app-card">
    <div class="card-body">
        <form method="POST" action="{{ route('contact.store') }}" class="row g-3">
            @csrf

            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input
                    name="name"
                    value="{{ old('name', auth()->user()?->name) }}"
                    required
                    maxlength="255"
                    class="form-control"
                >
            </div>

            <div class="col-md-6">
                <label class="form-label">Correo electrónico</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', auth()->user()?->email) }}"
                    required
                    maxlength="255"
                    class="form-control"
                >
            </div>

            <div class="col-12">
                <label class="form-label">Asunto</label>
                <input
                    name="subject"
                    value="{{ old('subject') }}"
                    required
                    minlength="4"
                    maxlength="150"
                    class="form-control"
                >
            </div>

            <div class="col-12">
                <label class="form-label">Mensaje</label>
                <textarea
                    name="message"
                    rows="7"
                    required
                    minlength="10"
                    maxlength="5000"
                    class="form-control"
                >{{ old('message') }}</textarea>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
