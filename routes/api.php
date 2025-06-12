<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//This link has extra info for how the token ability middleware alias is added
//in case teammates want to know more about it or smth idk
//https://laravel.com/docs/12.x/sanctum#token-ability-middleware

//All routes need to stay in the sanctum middleware since they all need a bearer token for an API user
//Check register.blade.php, web.php, and DevUserController.php for more info.
Route::middleware(['auth:sanctum', 'ability:API_KEY'])->group(function () {
    Route::post('/register', [UserController::class, 'register']);
//    Route::get('/login', [UserController::class, 'register']);
});
