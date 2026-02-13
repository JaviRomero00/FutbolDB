import { Link, usePage } from '@inertiajs/react';

export default function GuestLayout({ children }) {
    const { auth } = usePage().props;

    return (
        <div className="min-h-screen">
            <header className="site-header">
                <div className="site-header__inner">
                    <a className="site-logo" href="/">
                        FutbolDB
                    </a>

                    <nav className="site-nav" aria-label="Navegación principal">
                        <a href="/"><span className="nav-icon">🏠</span>Inicio</a>
                        <a href="/football"><span className="nav-icon">📊</span>Clasificación</a>
                        <a href={route('contact.create')}><span className="nav-icon">✉️</span>Contacto</a>
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
