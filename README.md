BelastroNet - Портал любителей астрономии Беларуси

Описание проекта
Веб-портал для белорусских любителей астрономии. Платформа для публикации новостей, статей, фотографий, видео и других материалов астрономической тематики. Реализована система авторизации и разграничения прав доступа для обычных пользователей и администраторов.

Технологический стек

Backend

Laravel ^12.0 и PHP ^8.2

MySQL ^8.4

Inertia.js ^2.0

Sanctum — API аутентификация для SPA

Fortify — полная аутентификация

Spatie permissions - управение ролями пользователей

Frontend

React ^19.0 — пользовательский интерфейс

Inertia.js React adapter ^2.0 — интеграция React с Laravel

Tailwind CSS ^4.0 — стилизация

Vite — сборщик фронтенда

Axios — HTTP клиент

Пакеты и инструменты

Backend (Composer)

Пакет -	Назначение
laravel/fortify	Полная аутентификация (логин, регистрация, восстановление пароля, двухфакторка)
laravel/sanctum	API аутентификация для SPA
inertiajs/inertia-laravel	Интеграция Inertia с Laravel
spatie/laravel-activitylog	Журнал активности пользователей
spatie/laravel-permission	Управление ролями (admin, user) и разрешениями

Frontend (npm)

Пакет - Назначение
@inertiajs/react	React адаптер для Inertia
react, react-dom	React библиотека
tailwindcss	CSS фреймворк
@vitejs/plugin-react	Vite плагин для React
axios	HTTP клиент
autoprefixer, postcss	Инструменты для Tailwind

Структура базы данных

Основные таблицы

users — пользователи (с подключенным Spatie Permission)

roles и model_has_roles — роли пользователей (Spatie)

activity_log — журнал действий (Spatie Activity Log)

Контентные таблицы

articles — научно-популярные статьи

news — новости астрономии

documents — документы и файлы

links — полезные ссылки (внешние)

sites — ссылки на сайты портала BelastroNet

photos — фотографии

videos — видео

Каждая таблица содержит поле user_id для настройки отношений в модели (ресурсы принадлежат пользователю) и соответствующие поля для контента.

Система ролей и прав доступа

admin — полный доступ ко всем ресурсам
user — зарегистрированный пользователь

Права доступа (Policies)
Для каждого ресурса реализована отдельная Policy:

Ресурс	Просмотр (index/show)	Создание (create/store)	Редактирование/Удаление
Статьи (Article)	Все (включая гостей)	Только admin	Только admin
Новости (News)	Все (включая гостей)	Только admin	Только admin
Документы (Document)	Все (включая гостей)	Только admin	Только admin
Ссылки (Link)	Все (включая гостей)	Только admin	Только admin
Сайты (Site)	Все (включая гостей)	Только admin	Только admin
Фото (Photo)	Все (включая гостей)	Любой авторизованный	Admin или автор
Видео (Video)	Все (включая гостей)	Любой авторизованный	Admin или автор

Маршруты

Ресурсные маршруты
Все маршруты используют Resource Controllers с защитой через authorizeResource():

/articles	ArticlesController	ArticlePolicy
/news		NewsController		NewsPolicy
/documents	DocumentsController	DocumentPolicy
/links		LinksController		LinkPolicy
/sites		SitesController		SitePolicy
/photos		PhotosController	PhotoPolicy
/videos		VideosController	VideoPolicy

Дополнительные маршруты

/search — поиск по сайту
/upload — загрузка файлов (фото, видео, документы)
/dashboard — личный кабинет (требуется авторизация)
/admin — панель администратора (требуется роль admin)
/activity-logs — панель просмотра логов (требуется роль admin)

Валидация запросов (Form Requests)

Для каждого ресурса созданы отдельные классы валидации:
Все Request проверяют авторизацию в методе authorize() и содержат соответствующие правила в rules().

Загрузка файлов

Контроллер UploadController обрабатывает загрузку файлов:
Автоматическое определение типа файла (img/movie/doc)
Сохранение в структурированные папки {type}/{date}/
Возврат публичного URL загруженного файла

Установка и запуск

Требования

PHP ^8.2
Composer
Node.js ^18
MySQL ^8.0

Установка

Клонирование репозитория
git clone https://github.com/username/belastronet.git
cd belastronet
Установка PHP зависимостей
composer install
Установка Node зависимостей
npm install
Копирование .env
cp .env.example .env
Генерация ключа
php artisan key:generate
Запуск миграций и сидов
php artisan migrate
php artisan db:seed --class=RolePermissionSeeder
php artisan db:seed --class=UserSeeder
Запуск локального сервера
php artisan serve
npm run dev

Актуальные проблемы и планы

Текущие проблемы
Настройка SSR (Server-Side Rendering) для Inertia
Scribe для автоматической документации

Планы развития
1	Тестирование — Unit и Feature тесты для политик и контроллеров
2	Поиск — внедрение Laravel Scout (Meilisearch/MySQL)

Вклад в проект
Проект находится в активной разработке. Предложения по улучшению приветствуются.