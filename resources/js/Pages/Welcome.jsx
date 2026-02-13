import { Head, Link } from '@inertiajs/react';

export default function Welcome({ auth, laravelVersion, phpVersion }) {
    return (
        <>
            <Head title="Bienvenido" />

            <div className="min-h-screen">
                <header className="site-header">
                    <div className="site-header__inner">
                        <Link className="site-logo" href="/">
                            FutbolDB
                        </Link>

                        <nav className="site-nav" aria-label="Navegación principal">
                            <Link href="/"><span className="nav-icon">🏠</span>Inicio</Link>
                            <Link href="/football"><span className="nav-icon">📊</span>Clasificación</Link>
                            <Link href={route('players.index')}><span className="nav-icon">👤</span>Jugadores</Link>
                            <Link href={route('teams.index')}><span className="nav-icon">🛡️</span>Equipos</Link>
                            <Link href={route('leagues.index')}><span className="nav-icon">🏆</span>Ligas</Link>
                        </nav>

                        <div className="site-auth">
                            {auth.user ? (
                                <Link href={route('dashboard')} className="btn btn-success btn-sm">
                                    Ir al panel
                                </Link>
                            ) : (
                                <>
                                    <Link href={route('login')} className="btn btn-outline-success btn-sm">
                                        Iniciar sesión
                                    </Link>
                                    <Link href={route('register')} className="btn btn-success btn-sm">
                                        Registrarse
                                    </Link>
                                </>
                            )}
                        </div>
                    </div>
                </header>

                <main className="page-wrap">
                    <div className="app-shell">
                        <div className="page-hero mb-4">
                            <h1>FutbolDB</h1>
                            <p>Base de datos y comunidad para seguir el fútbol profesional.</p>
                        </div>

                        <div className="card app-card">
                            <div className="card-body p-4 p-md-5">
                                <h2 className="section-title">Accesos rápidos</h2>
                                <div className="quick-actions">
                                    <Link href={route('players.index')} className="btn btn-primary"><span className="btn-icon">👤</span>Jugadores</Link>
                                    <Link href={route('teams.index')} className="btn btn-success"><span className="btn-icon">🛡️</span>Equipos</Link>
                                    <Link href={route('leagues.index')} className="btn btn-info"><span className="btn-icon">🏆</span>Ligas</Link>
                                </div>

                                <hr className="my-4" />

                                <p className="mb-1 text-muted">Laravel {laravelVersion}</p>
                                <p className="mb-0 text-muted">PHP {phpVersion}</p>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </>
    );
}
