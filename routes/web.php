<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Routes publiques du site (home, portfolio, pages statiques, contact).
| NB : Les noms de routes existants sont conservés.
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Projects
Route::name('projects.')
    ->prefix('projects')
    ->group(function (): void {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/{project:slug}', [ProjectController::class, 'show'])->name('show');
    });

// Static pages
Route::view('/about', 'about.index')->name('about');

// Contact
Route::controller(ContactController::class)
    ->prefix('contact')
    ->name('contact.')
    ->group(function (): void {
        Route::get('/', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });
