import React from 'react';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Login() {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/login');
    };

    return (
        <>
            <Head title="Вход" />
            <div className="min-h-screen flex items-center justify-center bg-gray-100">
                <div className="bg-white p-8 rounded-lg shadow-md w-96">
                    <h1 className="text-2xl font-bold mb-6 text-center">Вход</h1>
                    
                    <form onSubmit={handleSubmit}>
                        <div className="mb-4">
                            <label htmlFor="email" className="block text-gray-700 mb-2">
                                Email
                            </label>
                            <input
                                type="email"
                                id="email"
                                value={data.email}
                                onChange={e => setData('email', e.target.value)}
                                className="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500"
                                required
                            />
                            {errors.email && (
                                <p className="text-red-500 text-sm mt-1">{errors.email}</p>
                            )}
                        </div>

                        <div className="mb-4">
                            <label htmlFor="password" className="block text-gray-700 mb-2">
                                Пароль
                            </label>
                            <input
                                type="password"
                                id="password"
                                value={data.password}
                                onChange={e => setData('password', e.target.value)}
                                className="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500"
                                required
                            />
                            {errors.password && (
                                <p className="text-red-500 text-sm mt-1">{errors.password}</p>
                            )}
                        </div>

                        <div className="mb-4 flex items-center">
                            <input
                                type="checkbox"
                                id="remember"
                                checked={data.remember}
                                onChange={e => setData('remember', e.target.checked)}
                                className="mr-2"
                            />
                            <label htmlFor="remember">Запомнить меня</label>
                        </div>

                        <button
                            type="submit"
                            disabled={processing}
                            className="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition disabled:opacity-50"
                        >
                            Войти
                        </button>
                    </form>

                    <div className="mt-4 text-center text-sm text-gray-600">
                        <Link href="/register" className="text-blue-600 hover:underline">
                            Нет аккаунта? Зарегистрироваться
                        </Link>
                        <br />
                        <Link href="/forgot-password" className="text-blue-600 hover:underline">
                            Забыли пароль?
                        </Link>
                    </div>
                </div>
            </div>
        </>
    );
}