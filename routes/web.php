<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ControllerInsertTest;
use App\Http\Controllers\controllerquestions;


Route::get('/', function () {
    return view('welcome');
})->name('home');

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

Route::get('/table2', function () {
    return view('Table2');
})->name('table2');

Route::get('/inloggen', function () {
    $users = DB::table('users')->get();
    return view('Inloggen', compact('users'));
})->name('inloggen');

Route::get('/toetsmaken', [ControllerInsertTest::class, 'toetsmaken'])->name('toetsmaken');

// Test management
Route::post('/toetsmaken', [ControllerInsertTest::class, 'store'])->name('toets.store');
Route::post('/toetsmaken/update/{id}', [ControllerInsertTest::class, 'update'])->name('toets.update');
Route::get('/toetsmaken/delete/{id}', [ControllerInsertTest::class, 'delete'])->name('toets.delete');


Route::get('/toetsmaken', [ControllerInsertTest::class, 'toetsmaken'])->name('toetsmaken');

// Question management
Route::post('/toetsmaken', [controllerquestions::class, 'storeQuestion'])->name('question.store');
Route::post('/toetsmaken/update/{id}', [controllerquestions::class, 'updateQuestion'])->name('question.update');
Route::get('/toetsmaken/delete/{id}', [controllerquestions::class, 'deleteQuestion'])->name('question.delete');
