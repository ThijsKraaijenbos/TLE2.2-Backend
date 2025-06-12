<?php

use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;

//All routes need to stay in the sanctum middleware since they all need a bearer token for an API user
//Check register.blade.php, web.php, and DevUserController.php for more info.
Route::middleware(['auth:sanctum', [CheckForAnyAbility::class, 'API_KEY']])->group(function () {
    Route::get('/test', [\App\Http\Controllers\DevUserController::class, 'testLogin']);
});
