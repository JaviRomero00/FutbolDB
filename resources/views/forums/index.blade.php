@extends('layouts.app')

@section('title', 'Foros | FutbolDB')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h1 class="page-title mb-0">Foros</h1>
    <a href="{{ route('forums.create') }}" class="btn btn-primary">+ Nuevo foro</a>
</div>

<div class="card app-card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('forums.index') }}" class="row g-2 align-items-center">
            <div class="col-md-6">
                <input name="q" value="{{ $q }}" placeholder="Buscar por tema o contenido..." class="form-control">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success">Buscar</button>
            </div>
            @if($q)
                <div class="col-auto">
                    <a href="{{ route('forums.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                </div>
            @endif
        </form>
    </div>
</div>

<div class="card app-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 app-table">
            <thead>
            <tr>
                <th>Tema</th>
                <th>Autor</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($forums as $forum)
                <tr>
                    <td>
                        <a href="{{ route('forums.show', $forum) }}">{{ $forum->topic }}</a>
                    </td>
                    <td>{{ $forum->user?->name ?? 'Sin autor' }}</td>
                    <td>
                        @if($forum->is_active)
                            <span class="badge text-bg-success">Activo</span>
                        @else
                            <span class="badge text-bg-secondary">Cerrado</span>
                        @endif
                    </td>
                    <td>{{ $forum->created_at?->format('d/m/Y H:i') }}</td>
                    <td>
                        @if(auth()->id() === $forum->user_id || auth()->user()?->isAdmin())
                            <div class="d-flex gap-2">
                                <form action="{{ route('forums.toggle', $forum) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                        {{ $forum->is_active ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>

                                <form action="{{ route('forums.destroy', $forum) }}" method="POST" onsubmit="return confirm('¿Eliminar foro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-4">No hay foros disponibles.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $forums->appends(['q' => $q])->links() }}
</div>
@endsection
