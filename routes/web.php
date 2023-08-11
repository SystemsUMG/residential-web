<?php

use App\Http\Controllers\PenaltyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('templates.dashboard');
})->name('home');

Route::resource('penalties', PenaltyController::class);

//Rutas para ejemplos templates
Route::prefix('example')->group(function () {
    Route::get('buttons', function () {
        return view('templates.ui-buttons');
    })->name('buttons');

    Route::get('alerts', function () {
        return view('templates.ui-alerts');
    })->name('alerts');

    Route::get('cards', function () {
        return view('templates.ui-card');
    })->name('cards');

    Route::get('forms', function () {
        return view('templates.ui-forms');
    })->name('forms');

    Route::get('fonts', function () {
        return view('templates.ui-typography');
    })->name('fonts');

    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('icons', function () {
        return view('templates.icon-tabler');
    })->name('icons');

    Route::get('sample', function () {
        return view('templates.sample-page');
    })->name('sample');

});
