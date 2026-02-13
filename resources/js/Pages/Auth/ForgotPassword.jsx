import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, useForm } from '@inertiajs/react';

export default function ForgotPassword({ status }) {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('password.email'));
    };

    return (
        <GuestLayout>
            <Head title="Recuperar contraseña" />

            <h1 className="mb-2 text-2xl font-bold text-gray-800">Recuperar contraseña</h1>
            <p className="mb-4 text-sm text-gray-600">
                Introduce tu email y te enviaremos un enlace para restablecer la contraseña.
            </p>

            {status && <div className="mb-4 text-sm font-medium text-emerald-700">{status}</div>}

            <form onSubmit={submit}>
                <TextInput
                    id="email"
                    type="email"
                    name="email"
                    value={data.email}
                    className="mt-1 block w-full"
                    isFocused={true}
                    onChange={(e) => setData('email', e.target.value)}
                />

                <InputError message={errors.email} className="mt-2" />

                <div className="mt-4 flex items-center justify-end">
                    <PrimaryButton disabled={processing}>Enviar enlace</PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    );
}
