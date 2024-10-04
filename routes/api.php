<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [RegisterController::class, 'logout']);
    Route::controller(ProjectController::class)->group(function () {
        Route::post('project', 'store'); // Create
        Route::get('project/{project}', 'show'); // Get One
        Route::get('project', 'index'); // Get All
        Route::post('project/update', 'update'); // Update
        Route::post('project/delete', 'destroy'); // Delete
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('user/{id}', 'show');
    });
    // Route::Resource('project', ProjectController::class)
    //     ->only(['index', 'store', 'show', 'update', 'destroy']);
});

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->post('/me', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->delete('/me', function (Request $request) {
    return $request->user();
});
