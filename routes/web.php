<?php

use App\Http\Controllers\DevUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DevUserController::class, 'index'])->name('dev.index');
Route::post('/', [DevUserController::class, 'register'])->name('dev.register');

require __DIR__.'/auth.php';
