@extends('layouts.app')

@section('title', 'Equipos | FutbolDB')

@section('content')
@php
    $isAdmin = auth()->user()?->role === 'admin';
    $adminMessage = 'No posees los requisitos necesarios para implementar cambios.';
@endphp

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h1 class="page-title mb-0">Equipos</h1>
    @if (Route::has('teams.create'))
        @if($isAdmin)
            <a href="{{ route('teams.create') }}" class="btn btn-primary">+ Nuevo equipo</a>
        @else
            <a href="#"
               class="btn btn-primary"
               data-admin-action="blocked"
               data-message="{{ $adminMessage }}">+ Nuevo equipo</a>
        @endif
    @endif
</div>

<div class="card app-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 app-table">
            <thead>
                <tr>
                    <th>Equipo</th>
                    <th>Liga</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($teams as $t)
                <tr>
                    <td>{{ $t->name }}</td>
                    <td>{{ $t->league_name ?? '-' }}</td>
                    <td>
                        @if (Route::has('teams.edit'))
                            @if($isAdmin)
                                <a href="{{ route('teams.edit', $t->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
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
                <tr><td colspan="3" class="text-center py-4">No hay equipos.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
