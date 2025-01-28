<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.jsx'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificación de Ligas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Clasificación de Ligas</h1>

        <div class="mb-4">
            <form action="{{ url('/football') }}" method="get">
                <select name="league_id" class="form-control" onchange="this.form.submit()">
                    <option value="PD" {{ $leagueId === 'PD' ? 'selected' : '' }}>La Liga Española</option>
                    <option value="PL" {{ $leagueId === 'PL' ? 'selected' : '' }}>Premier League Inglesa</option>
                    <option value="BL1" {{ $leagueId === 'BL1' ? 'selected' : '' }}>Bundesliga Alemana</option>
                </select>
            </form>
        </div>

        @if (isset($standings['error']))
            <div class="alert alert-danger">
                {{ $standings['error'] }}
            </div>
        @else
            <h4 class="text-center">Clasificación de la Liga</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Equipo</th>
                        <th>Puntos</th>
                        <th>Jugados</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($standings['standings'][0]['table'] as $team)
                        <tr>
                            <td>{{ $team['position'] }}</td>
                            <td>{{ $team['team']['name'] }}</td>
                            <td>{{ $team['points'] }}</td>
                            <td>{{ $team['playedGames'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
