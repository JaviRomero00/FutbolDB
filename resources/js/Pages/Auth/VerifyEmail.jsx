import PrimaryButton from '@/Components/PrimaryButton';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function VerifyEmail({ status }) {
    const { post, processing } = useForm({});

    const submit = (e) => {
        e.preventDefault();
        post(route('verification.send'));
    };

    return (
        <GuestLayout>
            <Head title="Verificación de email" />

            <h1 className="mb-2 text-2xl font-bold text-gray-800">Verifica tu email</h1>
            <p className="mb-4 text-sm text-gray-600">
                Te enviamos un enlace de verificación. Si no lo recibiste, puedes pedir otro.
            </p>

            {status === 'verification-link-sent' && (
                <div className="mb-4 text-sm font-medium text-emerald-700">
                    Te hemos enviado un nuevo enlace de verificación.
                </div>
            )}

            <form onSubmit={submit}>
                <div className="mt-4 flex items-center justify-between">
                    <PrimaryButton disabled={processing}>Reenviar email</PrimaryButton>

                    <Link
                        href={route('logout')}
                        method="post"
                        as="button"
                        className="rounded-md text-sm text-emerald-700 underline hover:text-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                    >
                        Cerrar sesión
                    </Link>
                </div>
            </form>
        </GuestLayout>
    );
}
