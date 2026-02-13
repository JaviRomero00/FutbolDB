@extends('layouts.app')

@section('title', $forum->topic.' | Foro')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h1 class="page-title mb-0">{{ $forum->topic }}</h1>
    <div class="d-flex gap-2">
        @if(auth()->id() === $forum->user_id || auth()->user()?->isAdmin())
            <form action="{{ route('forums.toggle', $forum) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-secondary">
                    {{ $forum->is_active ? 'Desactivar foro' : 'Activar foro' }}
                </button>
            </form>
        @endif
        <a href="{{ route('forums.index') }}" class="btn btn-outline-secondary">Volver</a>
    </div>
</div>

<div class="card app-card">
    <div class="card-body">
        <div class="d-flex flex-wrap gap-3 text-muted mb-3">
            <span><strong>Autor:</strong> {{ $forum->user?->name ?? 'Sin autor' }}</span>
            <span><strong>Fecha:</strong> {{ $forum->created_at?->format('d/m/Y H:i') }}</span>
            <span>
                <strong>Estado:</strong>
                {{ $forum->is_active ? 'Activo' : 'Cerrado' }}
            </span>
        </div>

        <p class="mb-0" style="white-space: pre-line;">{{ $forum->content }}</p>
    </div>
</div>
@endsection
