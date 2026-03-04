import React from 'react';
import { Head, Link, router } from '@inertiajs/react';

export default function Dashboard() {
    const logout = () => {
        router.post('/logout');
    };

    return (
        <>
            <Head title="Dashboard" />
            <div className="min-h-screen bg-gray-100 p-8">
                <div className="max-w-4xl mx-auto">
                    <div className="bg-white rounded-lg shadow-md p-6">
                        <h1 className="text-2xl font-bold mb-4">Панель управления</h1>
                        <p className="mb-4">Вы успешно вошли в систему!</p>
                        
                        <button
                            onClick={logout}
                            className="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition"
                        >
                            Выйти
                        </button>
                    </div>
                </div>
            </div>
        </>
    );
}