import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Dashboard() {
    return (
        <AuthenticatedLayout title="Panel principal">
            <Head title="Panel principal" />

            <div className="card app-card">
                <div className="card-body p-4 p-md-5">
                    <h2 className="section-title">Sesión iniciada</h2>
                    <p className="text-muted mb-0">
                        Ya puedes navegar a jugadores, equipos y ligas desde el menú superior.
                    </p>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
