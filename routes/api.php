<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TimesheetController;
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
        Route::post('user', 'store'); // Create
        Route::get('user/{user}', 'show'); // Get One
        Route::get('user', 'index'); // Get All
        Route::post('user/update', 'update'); // Update
        Route::post('user/delete', 'destroy'); // Delete
    });
    Route::controller(TimesheetController::class)->group(function () {
        Route::post('timesheet', 'store'); // Create
        Route::get('timesheet/{timesheet}', 'show'); // Get One
        Route::get('timesheet', 'index'); // Get All
        Route::post('timesheet/update', 'update'); // Update
        Route::post('timesheet/delete', 'destroy'); // Delete
    });
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
