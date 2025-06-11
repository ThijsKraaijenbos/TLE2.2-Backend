<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/test', [\App\Http\Controllers\DevUserController::class, 'test']);
});
