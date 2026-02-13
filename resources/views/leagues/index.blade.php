@extends('layouts.app')

@section('title', 'Ligas | FutbolDB')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h1 class="page-title mb-0">Ligas</h1>
    @if (Route::has('leagues.create'))
        <a href="{{ route('leagues.create') }}" class="btn btn-primary">+ Nueva liga</a>
    @endif
</div>

<div class="card app-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 app-table">
            <thead>
                <tr>
                    <th>Liga</th>
                    <th>País</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($leagues as $l)
                <tr>
                    <td>{{ $l->name }}</td>
                    <td>{{ $l->country ?? '-' }}</td>
                    <td>
                        @if (Route::has('leagues.edit'))
                            <a href="{{ route('leagues.edit', $l->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center py-4">No hay ligas.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
