import { Link, usePage } from '@inertiajs/react';

export default function AuthenticatedLayout({ title, children }) {
    const user = usePage().props.auth.user;

    return (
        <div className="min-h-screen">
            <header className="site-header">
                <div className="site-header__inner">
                    <a className="site-logo" href="/">
                        FutbolDB
                    </a>

                    <nav className="site-nav" aria-label="Navegación principal">
                        <a href="/"><span className="nav-icon">🏠</span>Inicio</a>
                        <Link href={route('dashboard')}><span className="nav-icon">📋</span>Panel</Link>
                        <a href={route('players.index')}><span className="nav-icon">👤</span>Jugadores</a>
                        <a href={route('teams.index')}><span className="nav-icon">🛡️</span>Equipos</a>
                        <a href={route('leagues.index')}><span className="nav-icon">🏆</span>Ligas</a>
                        <a href={route('contact.create')}><span className="nav-icon">✉️</span>Contacto</a>
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
