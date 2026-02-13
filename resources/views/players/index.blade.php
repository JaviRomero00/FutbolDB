@extends('layouts.app')

@section('title', 'Jugadores | FutbolDB')

@section('content')
@php
    $isAdmin = auth()->user()?->role === 'admin';
    $adminMessage = 'No posees los requisitos necesarios para implementar cambios.';
@endphp

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h1 class="page-title mb-0">Jugadores</h1>
    @if (Route::has('players.create'))
        @if($isAdmin)
            <a href="{{ route('players.create') }}" class="btn btn-primary">+ Nuevo jugador</a>
        @else
            <a href="#"
               class="btn btn-primary"
               data-admin-action="blocked"
               data-message="{{ $adminMessage }}">+ Nuevo jugador</a>
        @endif
    @endif
</div>

<div class="card app-card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('players.index') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <input name="q" value="{{ $q }}" placeholder="Buscar por nombre..." class="form-control">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success">Buscar</button>
            </div>
            @if($q)
                <div class="col-auto">
                    <a href="{{ route('players.index') }}" class="btn btn-outline-secondary">Limpiar</a>
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
                <th>Nombre</th>
                <th>Equipo</th>
                <th>Liga</th>
                <th>Nacionalidad</th>
                <th>Goles</th>
                <th>Asist.</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($players as $p)
                <tr>
                    <td><a href="{{ route('players.show', $p->id) }}">{{ $p->name }}</a></td>
                    <td>{{ $p->team_name ?? '-' }}</td>
                    <td>{{ $p->league_name ?? '-' }}</td>
                    <td>{{ $p->nationality }}</td>
                    <td>{{ $p->goals }}</td>
                    <td>{{ $p->assists }}</td>
                    <td>
                        @if (Route::has('players.edit'))
                            @if($isAdmin)
                                <a href="{{ route('players.edit', $p->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            @else
                                <a href="#"
                                   class="btn btn-sm btn-outline-primary"
                                   data-admin-action="blocked"
                                   data-message="{{ $adminMessage }}">Editar</a>
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center py-4">No hay jugadores.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $players->appends(['q' => $q])->links() }}
</div>
@endsection
