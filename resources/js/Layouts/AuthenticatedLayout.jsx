import { Link, usePage } from '@inertiajs/react';

export default function AuthenticatedLayout({ title, children }) {
    const user = usePage().props.auth.user;

    return (
        <div className="min-h-screen">
            <header className="site-header">
                <div className="site-header__inner">
                    <Link className="site-logo" href="/">
                        FutbolDB
                    </Link>

                    <nav className="site-nav" aria-label="Navegación principal">
                        <Link href="/"><span className="nav-icon">🏠</span>Inicio</Link>
                        <Link href={route('dashboard')}><span className="nav-icon">📋</span>Panel</Link>
                        <Link href={route('players.index')}><span className="nav-icon">👤</span>Jugadores</Link>
                        <Link href={route('teams.index')}><span className="nav-icon">🛡️</span>Equipos</Link>
                        <Link href={route('leagues.index')}><span className="nav-icon">🏆</span>Ligas</Link>
                        <Link href={route('profile.edit')}><span className="nav-icon">⚙️</span>Perfil</Link>
                    </nav>

                    <div className="site-auth d-flex align-items-center gap-2">
                        <span className="text-muted small d-none d-md-inline">{user?.name}</span>
                        <Link
                            href={route('logout')}
                            method="post"
                            as="button"
                            className="btn btn-outline-danger btn-sm"
                        >
                            Cerrar sesión
                        </Link>
                    </div>
                </div>
            </header>

            <main className="page-wrap">
                <div className="app-shell">
                    {title && (
                        <div className="page-hero mb-4">
                            <h1>{title}</h1>
                        </div>
                    )}

                    {children}
                </div>
            </main>
        </div>
    );
}
