<?php

use App\Http\Controllers\Controllertoets;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ToetsController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authenticated dashboard
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



// Authenticated settings routes
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('student', function () {
    $tests = DB::table('testname')->get();

    return view('student', compact('tests'));
})->name('student');



// Auth routes
require __DIR__.'/auth.php';

// Public table2 page
Route::get('/table2', function () {
    return view('Table2');
})->name('table2');


// Inloggen view with users
Route::get('/inloggen', function () {
    $users = DB::table('users')->get();
    return view('Inloggen', compact('users'));
})->name('inloggen');

// Test creation/viewing
Route::get('/toetsmaken', [Controllertoets::class, 'toetsmaken'])->name('toetsmaken');

// Test routes
Route::post('/toets/store', [Controllertoets::class, 'storeTest'])->name('toets.store');
Route::post('/toets/update/{id}', [Controllertoets::class, 'updateTest'])->name('toets.update');
Route::get('/toets/delete/{id}', [Controllertoets::class, 'deleteTest'])->name('toets.delete');

// Question routes
Route::post('/question/store', [Controllertoets::class, 'storeQuestion'])->name('question.store');
Route::post('/question/update/{id}', [Controllertoets::class, 'updateQuestion'])->name('question.update');
Route::get('/question/delete/{id}', [Controllertoets::class, 'deleteQuestion'])->name('question.delete');



