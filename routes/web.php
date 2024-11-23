<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/layout', function () {
    return view('layout');
});

Route::get('login/', function () {
    return view('login');
});

Route::resource('/category',CategoryController::class);
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::resource('/product',ProductsController::class);
Route::get('/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
Route::put('/product/{id}', [ProductsController::class, 'update'])->name('product.update');
Route::get('/products', [ProductsController::class, 'showForBuyers'])->name('products.buyers');