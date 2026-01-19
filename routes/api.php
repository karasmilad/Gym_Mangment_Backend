<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TrainersController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working'
    ]);
});
Route::apiResource('member', MembersController::class);
Route::apiResource('trainer', TrainersController::class);
Route::apiResource('session', SessionsController::class);
Route::apiResource('category', CategoriesController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function() {
    // Get All Users
    Route::get('/users', [UserController::class, 'index']);
    // Get User By Id
    Route::get('/users/{id}', [UserController::class, 'getUserById']);
    // Edit User Role
    Route::post('/users/{user}/role', [UserController::class, 'updateRole']);
    // Get All Roles
    Route::get('/roles', [UserController::class, 'getRoles']);
});
?>