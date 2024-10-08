<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CastController;
use App\Http\Controllers\API\CastMovieController;
use App\Http\Controllers\API\GenresController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\ReviewsController;
use App\Http\Controllers\API\RolesController;

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


Route::prefix('v1')->group(function () {
    
    Route::apiResource('cast', CastController::class);
    Route::apiResource('genre', GenresController::class);
    Route::apiResource('movie', MovieController::class);
    Route::apiResource('role', RolesController::class);
    Route::apiResource('cast-movie', CastMovieController::class);
    Route::apiResource('profile', ProfileController::class);
    Route::apiResource('review', ReviewsController::class);
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('generate-otp-code', [AuthController::class, 'generateOtpCode']);
        Route::post('verifikasi-akun', [AuthController::class, 'verifikasi']);
    });
    Route::get('/me', [AuthController::class, 'getUser']);
    Route::post('/update-user', [AuthController::class, 'updateUser']);
    

});