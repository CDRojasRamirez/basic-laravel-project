<?php

use Illuminate\Support\Facades\Route;

// E-commerce Store - Main page
Route::get('/', function () {
    return view('products.index');
})->name('store');

// Admin Panel - Products management
Route::get('/admin/products', function () {
    return view('products.admin');
})->name('admin.products');


