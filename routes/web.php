<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MixMatchController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DetailProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
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

// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Rute untuk login
Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// Halaman layout
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('login/', function () {
    return view('login');
});
Route::get('/layout', function () {
    return view('layout');
});


// Rute untuk register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('login/', function () {
    return view('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::resource('/category',CategoryController::class);
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');


// Route::resource('/product',ProductsController::class);
// Route::get('/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
// Route::put('/product/{id}', [ProductsController::class, 'update'])->name('product.update');
// Route::get('/products', [ProductsController::class, 'showForBuyers'])->name('products.buyers');

// Rute untuk melihat produk bagi pembeli (dengan middleware auth)
Route::middleware('web','auth')->group(function () {
    Route::get('/products', [ProductsController::class, 'showForBuyers'])->name('products.buyers');
    
    // Rute lainnya yang memerlukan autentikasi
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/financial-report', [ProfileController::class, 'financialReport'])->name('financial.report');
    Route::get('/profile/product/create', [ProfileController::class, 'createProduct'])->name('product.create');
    Route::get('/editprofile', [ProfileController::class, 'editProfile'])->name('editprofile');
    // Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
    
    // Mix and Match
    Route::get('/mix-match', [MixMatchController::class, 'index'])->name('mix-match.index');
    
    
    
    
    // Favorit
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    
    // Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

});

//Profile Penjual
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/profile/financial-report', [ProfileController::class, 'financialReport'])->name('financial.report');
Route::get('/profile/product/create', [ProfileController::class, 'createProduct'])->name('product.create');
//Edit Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/editprofile', [ProfileController::class, 'editProfile'])->name('editprofile');


// Mix and Match
Route::get('/mix-match', [MixMatchController::class, 'index'])->name('mix-match.index');
Route::middleware(['auth'])->group(function () {

    // Produk
    Route::resource('/product', ProductsController::class);
    Route::put('/product/{id}', [ProductsController::class, 'update'])->name('product.update');
    Route::get('/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
});

//halaman detail product
Route::resource('/detailProducts', DetailProductsController::class);
//Route::put('/product/{id}', [ProductsController::class, 'update'])->name('product.update');
//Route::get('/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
//Route::get('/detailProducts', function () {return view('detailProducts.index');});
    



// Kategori
Route::resource('/category', CategoryController::class);
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

Route::middleware('auth')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});

// Rute untuk proses upload bukti pembayaran
Route::post('/checkout/upload-payment-proof', [CheckoutController::class, 'uploadPaymentProof'])->name('checkout.uploadPaymentProof');
