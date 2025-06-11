<?php

use Illuminate\Support\Facades\Route;


//Dev user logins (alleen voor ons belangrijk als devs)
Route::post('/dev-user', [\App\Http\Controllers\V1\DevUserController::class, 'register']);


Route::middleware(['auth:sanctum'])->group(function () {

});
