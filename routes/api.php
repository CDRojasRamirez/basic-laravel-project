<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// Products CRUD endpoints
Route::get('/products', [ProductController::class, 'index'])
    ->name('api.products.index');

Route::get('/products/{id}', [ProductController::class, 'show'])
    ->name('api.products.show')
    ->where('id', '[0-9]+');

Route::post('/products', [ProductController::class, 'store'])
    ->name('api.products.store');

Route::put('/products/{id}', [ProductController::class, 'update'])
    ->name('api.products.update')
    ->where('id', '[0-9]+');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])
    ->name('api.products.destroy')
    ->where('id', '[0-9]+');