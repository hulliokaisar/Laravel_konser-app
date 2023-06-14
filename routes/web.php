<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\TicketController;

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


Auth::routes();

// Route untuk akses 'guest'
Route::get('guest/login', [LoginController::class, 'showGuestLoginForm'])->name('guest.login');
Route::post('guest/login', [LoginController::class, 'guestLogin'])->name('guest.login.submit');

// Route untuk akses 'agenx'
Route::get('agenx/login', [LoginController::class, 'showAgenxLoginForm'])->name('agenx.login');
Route::post('agenx/login', [LoginController::class, 'agenxLogin'])->name('agenx.login.submit');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'ticket.index'])->name('home');

// Route untuk pemesanan tiket konser
Route::get('/', [TicketController::class, 'create'])->name('ticket.create');
Route::post('/ticket/store', [TicketController::class, 'store'])->name('ticket.store');
Route::get('/ticket/show/{token}', [TicketController::class, 'show'])->name('ticket.show');

// Route untuk modul admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/tickets', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/admin/tickets/edit/{id}', [TicketController::class, 'edit'])->name('ticket.edit');
    Route::post('/admin/tickets/update/{id}', [TicketController::class, 'update'])->name('ticket.update');
    Route::delete('/admin/tickets/delete/{id}', [TicketController::class, 'destroy'])->name('ticket.destroy');
});

// Route untuk modul check-in
Route::middleware(['auth'])->group(function () {
    Route::get('/check-in', [CheckInController::class, 'index'])->name('check-in.index');
    Route::post('/check-in/verify', [CheckInController::class, 'verify'])->name('check-in.verify');
});

// Route logout untuk kedua akses
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
