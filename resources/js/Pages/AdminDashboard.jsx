import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function AdminDashboard() {
    return (
        <AuthenticatedLayout title="Panel de administración">
            <Head title="Admin" />

            <div className="card app-card">
                <div className="card-body p-4 p-md-5">
                    <h2 className="section-title">Administración</h2>
                    <p className="mb-4 text-muted">
                        Zona reservada para gestionar contenidos, usuarios y datos maestros.
                    </p>

                    <div className="d-flex flex-wrap gap-2">
                        <a href="/admin/footer" className="btn btn-primary">
                            Editar footer (legal y contacto)
                        </a>

                        <a href="/players" className="btn btn-outline-secondary">
                            Gestionar jugadores
                        </a>

                        <a href="/teams" className="btn btn-outline-secondary">
                            Gestionar equipos
                        </a>

                        <a href="/leagues" className="btn btn-outline-secondary">
                            Gestionar ligas
                        </a>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
