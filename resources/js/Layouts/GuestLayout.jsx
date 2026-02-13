import { Link, usePage } from '@inertiajs/react';

export default function GuestLayout({ children }) {
    const { auth } = usePage().props;

    return (
        <div className="min-h-screen">
            <header className="site-header">
                <div className="site-header__inner">
                    <Link className="site-logo" href="/">
                        FutbolDB
                    </Link>

                    <nav className="site-nav" aria-label="Navegación principal">
                        <Link href="/"><span className="nav-icon">🏠</span>Inicio</Link>
                        <Link href="/football"><span className="nav-icon">📊</span>Clasificación</Link>
                        {auth?.user && <Link href={route('dashboard')}><span className="nav-icon">📋</span>Panel</Link>}
                    </nav>

                    <div className="site-auth">
                        {auth?.user ? (
                            <Link href={route('dashboard')} className="btn btn-success btn-sm">
                                Entrar al panel
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
                    <div className="card app-card mx-auto" style={{ maxWidth: 560 }}>
                        <div className="card-body p-4 p-md-5">{children}</div>
                    </div>
                </div>
            </main>
        </div>
    );
}
