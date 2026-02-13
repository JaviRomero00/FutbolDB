import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import DeleteUserForm from './Partials/DeleteUserForm';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm';

export default function Edit({ mustVerifyEmail, status }) {
    return (
        <AuthenticatedLayout title="Perfil">
            <Head title="Perfil" />

            <div className="space-y-4">
                <div className="card app-card">
                    <div className="card-body p-4 p-md-5">
                        <UpdateProfileInformationForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            className="max-w-xl"
                        />
                    </div>
                </div>

                <div className="card app-card">
                    <div className="card-body p-4 p-md-5">
                        <UpdatePasswordForm className="max-w-xl" />
                    </div>
                </div>

                <div className="card app-card">
                    <div className="card-body p-4 p-md-5">
                        <DeleteUserForm className="max-w-xl" />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
