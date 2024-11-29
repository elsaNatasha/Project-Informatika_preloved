<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MixMatchController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductController::class, 'index'])->name('products');


Route::resource('/category',CategoryController::class);
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');


Route::resource('/product',ProductsController::class);
Route::get('/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
Route::put('/product/{id}', [ProductsController::class, 'update'])->name('product.update');
Route::get('/products', [ProductsController::class, 'showForBuyers'])->name('products.buyers');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});
//Profile Penjual
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/profile/financial-report', [ProfileController::class, 'financialReport'])->name('financial.report');
Route::get('/profile/product/create', [ProfileController::class, 'createProduct'])->name('product.create');
Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
//Edit Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/editprofile', [ProfileController::class, 'editProfile'])->name('editprofile');


// Mix and Match
Route::get('/mix-match', [MixMatchController::class, 'index'])->name('mix-match.index');

//>>>>>>> Stashed changes
Route::middleware(['auth'])->group(function () {
    
});

// Route untuk menampilkan halaman favorit (menggunakan GET)
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

// Route untuk menambahkan favorit (menggunakan POST)
Route::middleware(['auth'])->post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');

// Route untuk menghapus favorit (menggunakan DELETE)
Route::middleware(['auth'])->delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

