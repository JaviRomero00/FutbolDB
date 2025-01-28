<header>
    <div class="logo">
        <a href="/">Logo</a>
    </div>
    <nav>
        <ul>
            <li><a href="/">Inicio</a></li>
            <li><a href="/profile">Perfil</a></li>
            <li><a href="/matches">Partidos</a></li>
            <li><a href="/leagues">Ligas</a></li>
            <li><a href="/forums">Foros</a></li>
        </ul>
    </nav>
    <div class="auth-options">
        @auth
            <!-- Si el usuario está autenticado -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">Cerrar sesión</button>
            </form>
        @else
            <!-- Si el usuario no está autenticado -->
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="text-gray-700 hover:text-green-600">Registrarse</a>
        @endauth
    </div>
</header>
