<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\Auth\RegisterController;
=======
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;

>>>>>>> 8902ebe0c2439c6d25fc1638a0470dd398032eba
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

/*Route::get('/', function () {
    return view('welcome');
<<<<<<< HEAD
});*/





Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
=======
});

Route::get('login/', function () {
    return view('login');
});

Route::get('/layout', function () {
    return view('layout');
});

Route::resource('/category',CategoryController::class);
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

>>>>>>> 8902ebe0c2439c6d25fc1638a0470dd398032eba
