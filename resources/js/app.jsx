import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';
import './bootstrap'; // если файл существует

createInertiaApp({
    // Функция для поиска страниц-компонентов
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true });
        return pages[`./Pages/${name}.jsx`];
    },
    // Настройка рендеринга
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />);
    },
});