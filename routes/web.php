<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\BlogManagementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PlayerManagementController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Website
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Players
Route::get('/players', [PlayerController::class, 'directory'])->name('players.directory');
Route::get('/players/{slug}', [PlayerController::class, 'profile'])->name('players.profile');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Join Sportika
Route::get('/join', [JoinController::class, 'index'])->name('join.index');
Route::post('/join', [JoinController::class, 'submit'])->name('join.submit');
Route::get('/join/success', [JoinController::class, 'success'])->name('join.success');

/*
|--------------------------------------------------------------------------
| Admin Auth
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Admin Panel (authenticated)
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin.auth')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Players Management
        Route::prefix('players')->name('players.')->group(function () {
            Route::get('/', [PlayerManagementController::class, 'index'])->name('index');
            Route::get('/create', [PlayerManagementController::class, 'create'])->name('create');
            Route::post('/', [PlayerManagementController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [PlayerManagementController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PlayerManagementController::class, 'update'])->name('update');
            Route::delete('/{id}', [PlayerManagementController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/toggle-publish', [PlayerManagementController::class, 'togglePublish'])->name('togglePublish');
            Route::post('/{id}/toggle-featured', [PlayerManagementController::class, 'toggleFeatured'])->name('toggleFeatured');
        });

        // Applications
        Route::prefix('applications')->name('applications.')->group(function () {
            Route::get('/', [ApplicationController::class, 'index'])->name('index');
            Route::get('/{id}', [ApplicationController::class, 'show'])->name('show');
            Route::post('/{id}/approve', [ApplicationController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [ApplicationController::class, 'reject'])->name('reject');
        });

        // Blog Management
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', [BlogManagementController::class, 'index'])->name('index');
            Route::get('/create', [BlogManagementController::class, 'create'])->name('create');
            Route::post('/', [BlogManagementController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [BlogManagementController::class, 'edit'])->name('edit');
            Route::put('/{id}', [BlogManagementController::class, 'update'])->name('update');
            Route::delete('/{id}', [BlogManagementController::class, 'destroy'])->name('destroy');
        });

        // Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    });
});
