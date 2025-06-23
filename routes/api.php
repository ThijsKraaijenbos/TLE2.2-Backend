<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\FriendUserController;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\FunFactController;
use App\Http\Controllers\StreakController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidateUserLoginToken;
use Illuminate\Support\Facades\Route;

//random comment to test deployment

//This link has extra info for how the token ability middleware alias is added
//in case teammates want to know more about it or smth idk
//https://laravel.com/docs/12.x/sanctum#token-ability-middleware

//All routes need to stay in the sanctum middleware since they all need a bearer token for an API user
//Check register.blade.php, web.php, and DevUserController.php for more info.
//Error: Invalid ability provided. means that an API key with the wrong ability was inserted (probably a regular user login token)
Route::middleware(['auth:sanctum', 'ability:API_KEY'])->group(function () {
    //Regular user registration, login (token return), and getting user info
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/user', [UserController::class, 'user'])->middleware(ValidateUserLoginToken::class);

    //list all friends
    Route::middleware([ValidateUserLoginToken::class])->group(function () {
        Route::get('/friends', [FriendUserController::class, 'showFriends']);
        Route::post('/friends', [FriendUserController::class, 'addFriend']);
    });

});


// Main routes for the app.
Route::apiResource('assignments', AssignmentController::class);
Route::apiResource('fruits', FruitController::class);
Route::apiResource('streaks', StreakController::class);
Route::apiResource('fun-facts', FunFactController::class);

Route::middleware([ValidateUserLoginToken::class])->group(function () {

    //Update streak
    Route::put('/updateStreak', [StreakController::class, 'updateByUser']);

    //Update user
    Route::put('/users/{user}', [UserController::class, 'update']);

});



