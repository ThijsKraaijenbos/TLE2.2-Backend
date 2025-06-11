<?php

use App\Http\Controllers\V1\DevUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DevUserController::class, 'index']);

require __DIR__.'/auth.php';
