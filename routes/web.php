<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MixMatchController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DetailProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;

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
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Rute untuk login
// Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman welcome
Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('redirectIfAuthenticated')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});

// role 1 => pembeli
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('buyer.products');
        Route::get('/{id}', [ProductsController::class, 'show'])->name('buyer.products.show');
    });

    Route::prefix('favorites')->group(function () {
        Route::get('/', [FavoriteController::class, 'index'])->name('favorites.index');
        Route::post('/', [FavoriteController::class, 'store'])->name('favorites.store');
        Route::delete('/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    });

    Route::prefix('carts')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('carts.index');
        Route::post('/', [CartController::class, 'store'])->name('carts.store');
        Route::delete('/{idProduct}', [CartController::class, 'destroy'])->name('carts.destroy');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
    });

    Route::prefix('transactions')->group(function () {
        Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
    });

    Route::prefix('mix-match')->group(function () {
        Route::get('/', [MixMatchController::class, 'index'])->name('mix-match.index');
        Route::get('/kustomisasi', [MixMatchController::class, 'kustomisasi'])->name('mix-match.kustomisasi');
    });

    // Route::get('/products', [ProductsController::class, 'index'])->name('buyer.products');
    // Route::get('/products/{id}', [ProductsController::class, 'show'])->name('buyer.products.show');

    // Route::get('/dashboard', [DashboardController::class, 'index']);
    // Route::get('/layout', function () {
    //     return view('layout');
    // });

    // Route::post('/cart', [CartController::class, 'store'])->name('cart.add');
});

// role 2 => penjual
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
            Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::put('/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        });

        Route::prefix('products')->group(function () {
            Route::get('/', [AdminProductController::class, 'index'])->name('admin.products');
            Route::post('/', [AdminProductController::class, 'store'])->name('admin.products.store');
            Route::get('/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
            Route::put('/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
            Route::delete('/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
        });
    });

    // Route::get('/products', [ProductsController::class, 'showForBuyers'])->name('products.buyers');
    // Route::get('/dashboard', [DashboardController::class, 'index']);
    // Route::get('/layout', function () {
    //     return view('layout');
    // });
});

// Halaman layout
// Route::post('/register', [RegisterController::class, 'register']);


// Route::get('login/', function () {
//     return view('login');
// });
// Route::get('/layout', function () {
//     return view('layout');
// });


// Rute untuk register
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);

// Route::get('login/', function () {
//     return view('login');
// });

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/products', [ProductsController::class, 'index'])->name('products');



// Route::resource('/category', CategoryController::class);
// Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
// Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');


// // Route::resource('/product',ProductsController::class);
// // Route::get('/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
// // Route::put('/product/{id}', [ProductsController::class, 'update'])->name('product.update');
// // Route::get('/products', [ProductsController::class, 'showForBuyers'])->name('products.buyers');

// // Rute untuk melihat produk bagi pembeli (dengan middleware auth)
// Route::middleware('web', 'auth')->group(function () {
//     Route::get('/products', [ProductsController::class, 'showForBuyers'])->name('products.buyers');

//     // Rute lainnya yang memerlukan autentikasi
//     Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

//     Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::get('/profile/financial-report', [ProfileController::class, 'financialReport'])->name('financial.report');
//     Route::get('/profile/product/create', [ProfileController::class, 'createProduct'])->name('product.create');
//     Route::get('/editprofile', [ProfileController::class, 'editProfile'])->name('editprofile');
//     // Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');

//     // Mix and Match
//     Route::get('/mix-match', [MixMatchController::class, 'index'])->name('mix-match.index');




//     // Favorit
//     Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
//     Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
//     Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

//     // Keranjang
//     Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//     Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
//     Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
//     Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
// });

// //Profile Penjual
// Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
// Route::get('/profile/financial-report', [ProfileController::class, 'financialReport'])->name('financial.report');
// Route::get('/profile/product/create', [ProfileController::class, 'createProduct'])->name('product.create');
// //Edit Profile
// Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// Route::get('/editprofile', [ProfileController::class, 'editProfile'])->name('editprofile');


// // Mix and Match
// Route::get('/mix-match', [MixMatchController::class, 'index'])->name('mix-match.index');
// Route::middleware(['auth'])->group(function () {

//     // Produk
//     Route::resource('/product', ProductsController::class);
//     Route::put('/product/{id}', [ProductsController::class, 'update'])->name('product.update');
//     Route::get('/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
// });

// //halaman detail product
// // Route::resource('/detailProducts', DetailProductsController::class);
// //Route::put('/product/{id}', [ProductsController::class, 'update'])->name('product.update');
// //Route::get('/product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
// //Route::get('/detailProducts', function () {return view('detailProducts.index');});




// // Kategori
// Route::resource('/category', CategoryController::class);
// Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
// Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

// Route::middleware('auth')->group(function () {
//     Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
//     Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
//     Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
// });

// // Rute untuk proses upload bukti pembayaran
// Route::post('/checkout/upload-payment-proof', [CheckoutController::class, 'uploadPaymentProof'])->name('checkout.uploadPaymentProof');
