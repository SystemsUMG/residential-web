<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Logout;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\Houses\Houses;
use App\Http\Livewire\Penalties\Penalties;
use App\Http\Livewire\PenaltyCategories\PenaltyCategories;
use App\Http\Livewire\Profile\Profile;
use App\Http\Livewire\TicketCategories\TicketCategories;
use App\Http\Livewire\Tickets\Tickets;
use App\Http\Livewire\Users\Users;
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
    //Route::get('register', Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('', Dashboard::class)->name('dashboard');

    Route::get('profile', Profile::class)->name('profile');

    Route::get('users', Users::class)->name('users');

    Route::get('houses', Houses::class)->name('houses');

    Route::prefix('tickets')->group(function () {
        Route::get('', Tickets::class)->name('tickets');
        Route::get('categories', TicketCategories::class)->name('tickets.categories');
    });

    Route::prefix('penalties')->group(function () {
        Route::get('', Penalties::class)->name('penalties');
        Route::get('categories', PenaltyCategories::class)->name('penalties.categories');
    });
});
