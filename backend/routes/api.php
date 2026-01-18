<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public menu routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{slug}', [CategoryController::class, 'show']);
Route::get('/menu', [MenuItemController::class, 'index']);
Route::get('/menu/featured', [MenuItemController::class, 'featured']);
Route::get('/menu/{slug}', [MenuItemController::class, 'show']);
Route::get('/menu/{menuItemId}/reviews', [ReviewController::class, 'index']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::put('/change-password', [AuthController::class, 'changePassword']);

    // Cart routes
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'add']);
    Route::put('/cart/{id}', [CartController::class, 'update']);
    Route::delete('/cart/{id}', [CartController::class, 'remove']);
    Route::delete('/cart', [CartController::class, 'clear']);

    // Order routes
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancel']);

    // Review routes
    Route::post('/reviews', [ReviewController::class, 'store']);

    // Admin routes
    Route::middleware('admin')->group(function () {
        
        // Category management
        Route::post('/admin/categories', [CategoryController::class, 'store']);
        Route::put('/admin/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy']);

        // Menu management
        Route::post('/admin/menu', [MenuItemController::class, 'store']);
        Route::put('/admin/menu/{id}', [MenuItemController::class, 'update']);
        Route::delete('/admin/menu/{id}', [MenuItemController::class, 'destroy']);

        // Order management
        Route::get('/admin/orders', [OrderController::class, 'adminIndex']);
        Route::put('/admin/orders/{id}/status', [OrderController::class, 'updateStatus']);

        // Review management
        Route::put('/admin/reviews/{id}/approve', [ReviewController::class, 'approve']);
        Route::delete('/admin/reviews/{id}', [ReviewController::class, 'destroy']);
    });
});
