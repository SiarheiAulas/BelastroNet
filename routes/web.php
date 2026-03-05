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

Route::resource('/articles', ArticlesController::class);

Route::resource('/documents', DocumentsController::class);

Route::resource('/links', LinksController::class);

Route::resource('/sites', SitesController::class);

Route::resource('/news', NewsController::class);

Route::resource('/photos', PhotosController::class);

Route::resource('/videos', VideosController::class);

Route::get('/search',[SearchController::class,'index'])->name('search');

Route::post('/upload',[UploadController::class, 'upload'])->name('upload');