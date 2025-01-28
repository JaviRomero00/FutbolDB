
@section('content')
<div x-data="{ search: '' }">
    <input type="text" x-model="search" placeholder="Buscar jugador...">

    <ul>
        @foreach ($players as $player)
        <li x-show="search === '' || '{{ strtolower($player->name) }}'.includes(search.toLowerCase())">
            <a href="/players/{{ $player->id }}">{{ $player->name }}</a> - {{ $player->team->name }}
        </li>
        @endforeach
    </ul>
</div>
@endsection
