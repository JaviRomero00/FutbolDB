<header class="site-header">
    <div class="site-header__inner">
        <a class="site-logo" href="{{ route('home') }}">FutbolDB</a>

        <nav class="site-nav" aria-label="Navegación principal">
            <a href="{{ route('home') }}"><span class="nav-icon">🏠</span>Inicio</a>
            <a href="{{ route('football.index') }}"><span class="nav-icon">📊</span>Clasificación</a>
            <a href="{{ route('players.index') }}"><span class="nav-icon">👤</span>Jugadores</a>
            <a href="{{ route('teams.index') }}"><span class="nav-icon">🛡️</span>Equipos</a>
            <a href="{{ route('leagues.index') }}"><span class="nav-icon">🏆</span>Ligas</a>
            @auth
                <a href="{{ route('dashboard') }}"><span class="nav-icon">📋</span>Panel</a>
                <a href="{{ route('profile.edit') }}"><span class="nav-icon">⚙️</span>Perfil</a>
            @endauth
        </nav>

        <div class="site-auth">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Cerrar sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn btn-success btn-sm">Registrarse</a>
            @endauth
        </div>
    </div>
</header>
