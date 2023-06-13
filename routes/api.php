<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvitationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/invite', [InvitationController::class, 'invite']);

    Route::post('/logout', [UserController::class, 'logout']);
});

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register']);
