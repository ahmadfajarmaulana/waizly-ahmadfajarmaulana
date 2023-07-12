<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('must-supper-admin')->group(function() {
        Route::post('user', [UserController::class, 'createUser']);
        Route::get('user/{id}', [UserController::class, 'getUserById']);
        Route::put('user/{id}', [UserController::class, 'updateUser']);
        Route::delete('user/{id}', [UserController::class, 'deleteUser']);

        Route::put('product/{id}', [ProductController::class, 'updateProduct']);
        Route::post('product', [ProductController::class, 'createProduct']);
        Route::delete('product/{id}', [ProductController::class, 'deleteProduct']);

        Route::get('role', [RoleController::class, 'getAllRoles']);
        Route::put('role/{id}', [RoleController::class, 'updateRole']);
        Route::post('role', [RoleController::class, 'createRole']);
        Route::delete('role/{id}', [RoleController::class, 'deleteRole']);

        Route::put('category/{id}', [CategoryController::class, 'updateCategory']);
        Route::post('category', [CategoryController::class, 'createCategory']);
        Route::delete('category/{id}', [CategoryController::class, 'deleteCategory']);
    });

    Route::get('user', [UserController::class, 'getAllUsers']);

    Route::get('product', [ProductController::class, 'getAllProducts']);
    Route::get('product/{id}', [ProductController::class, 'getProductById']);

    Route::get('category', [CategoryController::class, 'getAllCategories']);
    Route::get('category/{id}', [CategoryController::class, 'getCategoryById']);
});