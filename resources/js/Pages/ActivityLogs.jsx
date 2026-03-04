import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';

export default function ActivityLogs({ logs }) {
    const [expandedRow, setExpandedRow] = useState(null);

    const formatDate = (date) => {
        return new Date(date).toLocaleString('ru-RU', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
    };

    const getEventType = (description) => {
        if (description.includes('created')) return 'created';
        if (description.includes('updated')) return 'updated';
        if (description.includes('deleted')) return 'deleted';
        return 'other';
    };

    const getEventStyle = (type) => {
        switch(type) {
            case 'created':
                return 'bg-green-100 text-green-800';
            case 'updated':
                return 'bg-blue-100 text-blue-800';
            case 'deleted':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    };

    const getEventText = (description) => {
        const map = {
            'created': 'Создание',
            'updated': 'Обновление',
            'deleted': 'Удаление'
        };
        return map[description] || description;
    };

    const getModelName = (type) => {
        if (!type) return '—';
        const parts = type.split('\\');
        return parts[parts.length - 1];
    };

    const toggleRow = (id) => {
        setExpandedRow(expandedRow === id ? null : id);
    };

    const handlePageChange = (page) => {
        router.get('/activity-logs', { page }, {
            preserveState: true,
            preserveScroll: true
        });
    };

    return (
        <>
            <Head title="Журнал активности" />
            
            <div className="py-6">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {/* Заголовок */}
                    <div className="mb-6">
                        <h1 className="text-2xl font-semibold text-gray-900">Журнал активности</h1>
                        <p className="text-sm text-gray-600 mt-1">
                            Все действия пользователей в системе
                        </p>
                    </div>

                    {/* Статистика */}
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div className="bg-white rounded-lg shadow p-4">
                            <div className="text-sm font-medium text-gray-500">Всего записей</div>
                            <div className="text-2xl font-semibold text-gray-900">{logs.total}</div>
                        </div>
                        <div className="bg-white rounded-lg shadow p-4">
                            <div className="text-sm font-medium text-gray-500">Созданий</div>
                            <div className="text-2xl font-semibold text-green-600">
                                {logs.data.filter(l => l.description === 'created').length}
                            </div>
                        </div>
                        <div className="bg-white rounded-lg shadow p-4">
                            <div className="text-sm font-medium text-gray-500">Обновлений</div>
                            <div className="text-2xl font-semibold text-blue-600">
                                {logs.data.filter(l => l.description === 'updated').length}
                            </div>
                        </div>
                        <div className="bg-white rounded-lg shadow p-4">
                            <div className="text-sm font-medium text-gray-500">Удалений</div>
                            <div className="text-2xl font-semibold text-red-600">
                                {logs.data.filter(l => l.description === 'deleted').length}
                            </div>
                        </div>
                    </div>

                    {/* Таблица логов */}
                    <div className="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div className="overflow-x-auto">
                            <table className="min-w-full divide-y divide-gray-200">
                                <thead className="bg-gray-50">
                                    <tr>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Время
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Пользователь
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Действие
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Объект
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Детали
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="bg-white divide-y divide-gray-200">
                                    {logs.data.map((log) => {
                                        const eventType = getEventType(log.description);
                                        return (
                                            <React.Fragment key={log.id}>
                                                {/* Основная строка */}
                                                <tr 
                                                    className="hover:bg-gray-50 cursor-pointer"
                                                    onClick={() => toggleRow(log.id)}
                                                >
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {formatDate(log.created_at)}
                                                    </td>
                                                    <td className="px-6 py-4 whitespace-nowrap">
                                                        <div className="flex items-center">
                                                            <div className="ml-4">
                                                                <div className="text-sm font-medium text-gray-900">
                                                                    {log.causer?.name || 'Система'}
                                                                </div>
                                                                <div className="text-xs text-gray-500">
                                                                    ID: {log.causer?.id || '-'} • 
                                                                    Email: {log.causer?.email || '-'}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td className="px-6 py-4 whitespace-nowrap">
                                                        <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getEventStyle(eventType)}`}>
                                                            {getEventText(log.description)}
                                                        </span>
                                                    </td>
                                                    <td className="px-6 py-4">
                                                        <div className="text-sm text-gray-900">
                                                            {getModelName(log.subject_type)}
                                                        </div>
                                                        <div className="text-xs text-gray-500">
                                                            ID: {log.subject_id || '-'}
                                                        </div>
                                                    </td>
                                                    <td className="px-6 py-4 text-sm text-gray-500">
                                                        <button 
                                                            className="text-blue-600 hover:text-blue-900"
                                                            onClick={(e) => {
                                                                e.stopPropagation();
                                                                toggleRow(log.id);
                                                            }}
                                                        >
                                                            {expandedRow === log.id ? 'Скрыть' : 'Подробнее'}
                                                        </button>
                                                    </td>
                                                </tr>
                                                
                                                {/* Раскрывающаяся строка с деталями */}
                                                {expandedRow === log.id && (
                                                    <tr className="bg-gray-50">
                                                        <td colSpan="5" className="px-6 py-4">
                                                            <div className="grid grid-cols-2 gap-4">
                                                                {/* Свойства */}
                                                                {log.properties && (
                                                                    <>
                                                                        {log.properties.attributes && (
                                                                            <div>
                                                                                <h4 className="text-sm font-medium text-gray-900 mb-2">
                                                                                    Новые значения:
                                                                                </h4>
                                                                                <pre className="text-xs bg-white p-2 rounded border overflow-auto max-h-40">
                                                                                    {JSON.stringify(log.properties.attributes, null, 2)}
                                                                                </pre>
                                                                            </div>
                                                                        )}
                                                                        {log.properties.old && (
                                                                            <div>
                                                                                <h4 className="text-sm font-medium text-gray-900 mb-2">
                                                                                    Старые значения:
                                                                                </h4>
                                                                                <pre className="text-xs bg-white p-2 rounded border overflow-auto max-h-40">
                                                                                    {JSON.stringify(log.properties.old, null, 2)}
                                                                                </pre>
                                                                            </div>
                                                                        )}
                                                                        {!log.properties.attributes && !log.properties.old && (
                                                                            <div className="col-span-2">
                                                                                <h4 className="text-sm font-medium text-gray-900 mb-2">
                                                                                    Дополнительные данные:
                                                                                </h4>
                                                                                <pre className="text-xs bg-white p-2 rounded border overflow-auto">
                                                                                    {JSON.stringify(log.properties, null, 2)}
                                                                                </pre>
                                                                            </div>
                                                                        )}
                                                                    </>
                                                                )}
                                                            </div>
                                                            
                                                            {/* IP и User Agent */}
                                                            {log.properties?.ip && (
                                                                <div className="mt-4 text-xs text-gray-500 border-t pt-2">
                                                                    <div>IP: {log.properties.ip}</div>
                                                                    {log.properties.user_agent && (
                                                                        <div className="truncate" title={log.properties.user_agent}>
                                                                            User Agent: {log.properties.user_agent}
                                                                        </div>
                                                                    )}
                                                                </div>
                                                            )}
                                                        </td>
                                                    </tr>
                                                )}
                                            </React.Fragment>
                                        );
                                    })}
                                </tbody>
                            </table>
                        </div>

                        {/* Пагинация */}
                        {logs.links && (
                            <div className="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                <div className="flex-1 flex justify-between sm:hidden">
                                    {logs.prev_page_url && (
                                        <button
                                            onClick={() => handlePageChange(logs.current_page - 1)}
                                            className="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                        >
                                            Назад
                                        </button>
                                    )}
                                    {logs.next_page_url && (
                                        <button
                                            onClick={() => handlePageChange(logs.current_page + 1)}
                                            className="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                        >
                                            Вперед
                                        </button>
                                    )}
                                </div>
                                <div className="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p className="text-sm text-gray-700">
                                            Показано с
                                            <span className="font-medium"> {logs.from} </span>
                                            по
                                            <span className="font-medium"> {logs.to} </span>
                                            из
                                            <span className="font-medium"> {logs.total} </span>
                                            записей
                                        </p>
                                    </div>
                                    <div>
                                        <nav className="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                            {logs.links.map((link, index) => (
                                                <button
                                                    key={index}
                                                    onClick={() => link.url && handlePageChange(link.label)}
                                                    disabled={!link.url}
                                                    className={`relative inline-flex items-center px-4 py-2 border text-sm font-medium
                                                        ${!link.url ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : ''}
                                                        ${link.active 
                                                            ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' 
                                                            : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
                                                        }
                                                        ${index === 0 ? 'rounded-l-md' : ''}
                                                        ${index === logs.links.length - 1 ? 'rounded-r-md' : ''}
                                                    `}
                                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                                />
                                            ))}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </>
    );
}