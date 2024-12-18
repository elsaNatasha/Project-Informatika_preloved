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
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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

        Route::prefix('orders')->group(function () {
            Route::get('/', [AdminOrderController::class, 'index'])->name('admin.orders');
            Route::get('/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
            Route::put('/{id}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
        });
    });
});
