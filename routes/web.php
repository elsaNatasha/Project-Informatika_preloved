<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FinancialReportController;

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


Route::get('laporan_keuangan/', function () {
    return view('laporan_keuangan');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('login/', function () {
    return view('login');
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

//<<<<<<< Updated upstream
Route::resource('/product',ProductsController::class);
Route::get('/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
Route::put('/product/{id}', [ProductsController::class, 'update'])->name('product.update');
Route::get('/products', [ProductsController::class, 'showForBuyers'])->name('products.buyers');


// Route::middleware(['auth'])->group(function () {
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
// });
//Profile Penjual
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/profile/financial-report', [ProfileController::class, 'financialReport'])->name('financial.report');
Route::get('/profile/product/create', [ProfileController::class, 'createProduct'])->name('product.create');
Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
//Edit Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
//>>>>>>> Stashed changes

Route::middleware('auth')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::post('/favorite/{product}', [FavoriteController::class, 'store'])->name('favorite.store');
});
