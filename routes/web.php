<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ControllerQuestions; // Controller for questions & tests

Route::get('/', fn() => view('welcome'))->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::get('/table2', fn() => view('Table2'))->name('table2');

Route::get('/inloggen', fn() => view('Inloggen', ['users' => DB::table('users')->get()]))
    ->name('inloggen');

// Main page for managing tests and questions
Route::get('/toetsmaken', [ControllerQuestions::class, 'toetsmaken'])->name('toetsmaken');

// Test CRUD routes
Route::post('/toetsmaken', [ControllerQuestions::class, 'storeTest'])->name('toets.store');
Route::post('/toetsmaken/update-test/{id}', [ControllerQuestions::class, 'updateTest'])->name('toets.update');
Route::get('/toetsmaken/delete-test/{id}', [ControllerQuestions::class, 'deleteTest'])->name('toets.delete');

// Question CRUD routes
Route::post('/questions', [ControllerQuestions::class, 'storeQuestion'])->name('question.store');
Route::post('/questions/update/{id}', [ControllerQuestions::class, 'updateQuestion'])->name('question.update');
Route::get('/questions/delete/{id}', [ControllerQuestions::class, 'deleteQuestion'])->name('question.delete');
