<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ActivityLogsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserIndexShowController;

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return Inertia::render('Admin');
    })->name('admin');
    
    Route::get('/activity-logs', [ActivityLogsController::class, 'index'])->name('logs');
});

Route::get('/search',[SearchController::class,'search'])->name('search');
Route::post('/upload',[UploadController::class, 'upload'])->name('upload');
Route::get('/users', [UserIndexShowController::class, 'index'])->name('users_index');
Route::get('/users/{user}', [UserIndexShowController::class, 'show'])->name('user_profile');
Route::get('/articles/type/{type}', [ArticlesController::class, 'sort_by_type'])->name('articles_by_type');
Route::get('/photos/type/{type}', [PhotosController::class, 'sort_by_type'])->name('photos_by_type');
Route::get('/videos/type/{type}', [VideosController::class, 'sort_by_type'])->name('videos_by_type');
Route::get('/articles/author/{author}', [ArticlesController::class, 'sort_by_author'])->name('articles_by_author');
Route::get('/photos/author/{author}', [PhotosController::class, 'sort_by_author'])->name('photos_by_author');
Route::get('/videos/author/{author}', [VideosController::class, 'sort_by_author'])->name('videos_by_author');

Route::get('/photos/my', [PhotosController::class, 'my_photos'])->name('my_photos');
Route::get('/videos/my', [VideosController::class, 'my_videos'])->name('my_videos');

Route::resource('/articles', ArticlesController::class);
Route::resource('/documents', DocumentsController::class);
Route::resource('/links', LinksController::class);
Route::resource('/sites', SitesController::class);
Route::resource('/news', NewsController::class);
Route::resource('/photos', PhotosController::class);
Route::resource('/videos', VideosController::class);