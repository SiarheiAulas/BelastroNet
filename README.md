BelastroNet - Портал любителей астрономии Беларуси

Технологический стек

- Laravel ^12.0
- Inertia.js ^2.0 
- React ^19.0 
- Tailwind CSS ^4.0
- Sanctum
- Fortify
- Activity Log (spatie/laravel-activitylog)
- Spatie-permission ^7.2.3

Установленные пакеты

Backend (Composer)
- `laravel/fortify` — полная аутентификация
- `laravel/sanctum` — API аутентификация для SPA
- `inertiajs/inertia-laravel` — интеграция Inertia
- `spatie/laravel-activitylog` — журнал активности
- `spatie/laravel-permission` — управление ролями и разрешениями пользователей

Frontend (npm)
- `@inertiajs/react` — React адаптер для Inertia
- `react`, `react-dom` — React
- `tailwindcss` — CSS фреймворк
- `@vitejs/plugin-react` — Vite плагин для React
- `axios` — HTTP клиент
- `autoprefixer`, `postcss` — для Tailwind

Основные маршруты

| Маршрут | Метод | Описание |
|---------|-------|----------|
|в разработке

Переменные окружения (.env)

APP_NAME=
APP_URL=
SESSION_DOMAIN=
SANCTUM_STATEFUL_DOMAINS=
MAIL_MAILER=

Актуальные проблемы: настройка SSR