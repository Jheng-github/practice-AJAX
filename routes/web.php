<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('products');
// });

Route::get('/',[ProductController::class, 'index'])->name('products'); 

Route::post('/add-product',[ProductController::class, 'store'])->name('store.products'); 
Route::post('/update-product',[ProductController::class, 'update'])->name('update.products'); 
Route::post('/delete-product',[ProductController::class, 'delete'])->name('delete.products'); 
Route::post('/search-product',[ProductController::class, 'search'])->name('search-product'); 