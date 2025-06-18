<?php

use App\Http\Controllers\DevUserController;
use App\Http\Controllers\FruitController;
use Illuminate\Support\Facades\Route;

//Breeze's routes often direct to the dashboard, this is here so we don't have to mess with everything
Route::view('/dashboard', 'devPanel.home')->name('dashboard');
Route::permanentRedirect('/dashboard', '/');

Route::view('/', 'devPanel.home')->name('home');

// Make sure every route besides the home page is in this middleware
Route::middleware('can:admin')->group(function () {

    Route::get('/fruits', [FruitController::class, 'adminIndex'])->name('adminFruits');

});

require __DIR__.'/auth.php';
