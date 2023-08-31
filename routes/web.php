<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Logout;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Penalties\Penalties;
use App\Http\Livewire\PenaltyCategories\PenaltyCategories;
use App\Http\Livewire\TicketCategories\TicketCategories;
use App\Http\Livewire\Tickets\Tickets;
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

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('logout', Logout::class)->name('logout');
    Route::get('register', Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('templates.dashboard');
    })->name('home');
    Route::prefix('tickets')->group(function () {
        Route::get('', Tickets::class)->name('tickets');
        Route::get('categories', TicketCategories::class)->name('tickets.categories');
    });
    Route::prefix('penalties')->group(function () {
        Route::get('', Penalties::class)->name('penalties');
        Route::get('categories', PenaltyCategories::class)->name('penalties.categories');
    });

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

        Route::get('icons', function () {
            return view('templates.icon-tabler');
        })->name('icons');

        Route::get('sample', function () {
            return view('templates.sample-page');
        })->name('sample');
    });

});
