<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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

use Illuminate\Support\Facades\DB;

Route::get('/inloggen', function () {
    $users = DB::table('users')->get(); // ✅ Fetch users from DB
    return view('Inloggen', compact('users')); // ✅ Pass to Blade
})->name('inloggen');

use App\Http\Controllers\controllerinserttest;

Route::get('/toetsmaken', [controllerinserttest::class, 'toetsmaken'])->name('toetsmaken');
Route::post('/toetsmaken', [controllerinserttest::class, 'store'])->name('toets.store');
Route::post('/toetsmaken/update/{id}', [controllerinserttest::class, 'update'])->name('toets.update');
Route::get('/toetsmaken/delete/{id}', [controllerinserttest::class, 'delete'])->name('toets.delete');
