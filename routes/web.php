<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Livewire\Volt\Volt;

// --- Home page ---
Route::get('/', function () {
    return view('welcome');
})->name('home');

// --- Authenticated Dashboard using controller ---
Route::get('/dashboard', [UserController::class, 'showDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('students.dashboard');

// --- Student creation route ---
Route::post('/students/create', [UserController::class, 'storeStudent'])
    ->middleware(['auth'])
    ->name('students.store');

// --- Volt settings (only for authenticated users) ---
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// --- Other pages ---
Route::get('/table1', fn () => view('Table1'))->name('table1');
Route::get('/table2', fn () => view('Table2'))->name('table2');
Route::get('/inloggen', fn () => view('Inloggen'))->name('inloggen');

// --- Old users test route (optional) ---
Route::get('/users', [UserController::class, 'databasetestconnection'])->name('users');

// --- Auth routes (login, register, etc.) ---
require __DIR__.'/auth.php';
