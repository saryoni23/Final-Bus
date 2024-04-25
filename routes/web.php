<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\TransportasiController;
use App\Http\Controllers\TypeController;
use App\Livewire\Rute\RuteIndex;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\TransactionController;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/',         [Controller::class, 'index'])->name('Home');


Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/destination', function () {
    return view('destination');
});

Route::get('/contact', function () {
    return view('contact');
});
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

        //  Airline Route
    Route::resource('/transportasi', TransportasiController::class)->middleware(['auth', 'verified', 'can:isAdmin']);
    
    //  Type Route
    Route::resource('/types', TypeController::class)->middleware(['auth', 'verified', 'can:isAdmin']);

    // Print Testing Route
    Route::get('/print', [PrintController::class, 'index'])->middleware(['auth', 'verified']);
    
    Route::get('/printpdf', [PrintController::class, 'print'])->middleware(['auth', 'verified']);
    
    // Complaint Route
    Route::resource('/complaints', ComplaintController::class)->middleware(['auth', 'verified']);
    
    //  Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);
    
    //  Order Route
    Route::resource('/orders', OrderController::class)->middleware(['auth', 'verified']);
    
    //  Transaction Route
    Route::resource('/transactions', TransactionController::class)->middleware(['auth', 'verified']);
    
    //  Type Route
    Route::resource('/tracks', TrackController::class)->middleware(['auth', 'verified', 'can:isAdmin']);
    
    //  Track Route
    Route::resource('/tracks', TrackController::class)->middleware(['auth', 'verified', 'can:isAdmin']);

    //  Ticket Route
    Route::resource('/tickets', TicketController::class)->middleware(['auth', 'verified']);

    //  Price Route
    Route::resource('/prices', PriceController::class)->middleware(['auth', 'verified']);

    //  Method Route
    Route::resource('/methods', MethodController::class)->middleware(['auth', 'verified', 'can:isAdmin','can:isKaryawan']);

    //  User Route
    Route::resource('/users', UserController::class)->middleware(['auth', 'verified']);

    // Check Price Route
    Route::get('/checkprice', [OrderController::class, 'checkprice', 'verified']);
});


// Route::resource('/pay', PayController::class)->middleware(['auth', 'verified']);

// Route::post('/midtrans-callback', [PayController::class, 'callback']);


Route::get('/pay1/{id}', [TransactionController::class,'pay1'])->middleware(['auth', 'verified']);



Route::post('/uprole/{id}',     [UserController::class, 'uprole']);
Route::post('/downrole/{id}',     [UserController::class, 'downrole']);



