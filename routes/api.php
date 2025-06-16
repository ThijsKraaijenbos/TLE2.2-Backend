<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//random comment to test deployment

//This link has extra info for how the token ability middleware alias is added
//in case teammates want to know more about it or smth idk
//https://laravel.com/docs/12.x/sanctum#token-ability-middleware

//All routes need to stay in the sanctum middleware since they all need a bearer token for an API user
//Check register.blade.php, web.php, and DevUserController.php for more info.
//Error: Invalid ability provided. means that an API key with the wrong ability was inserted (probably a regular user login token)
Route::middleware(['auth:sanctum', 'ability:API_KEY'])->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/user', [UserController::class, 'user']);
});


// Main routes for the app.



