<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// RouteServiceProvider
Route::get('/redirect', [HomeController::class, 'redirect']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/view_category', [AdminController::class, 'view_category'])->middleware('admin');
Route::post('/add_category', [AdminController::class, 'add_category'])->middleware('admin');
Route::get('/delete_category/{id}', [AdminController::class, 'delete_category'])->middleware('admin');

Route::get('/view_product', [AdminController::class, 'view_product'])->middleware('admin');

Route::post('/add_product', [AdminController::class, 'add_product'])->middleware('admin');
Route::get('/show_product', [AdminController::class, 'show_product'])->middleware('admin');

Route::get('/delete_product/{id}', [AdminController::class, 'delete_product'])->middleware('admin');
Route::get('/update_product/{id}', [AdminController::class, 'update_product'])->middleware('admin');

Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm'])->middleware('admin');

Route::get('/product_details/{id}', [HomeController::class, 'product_details']);

Route::post('/add_cart/{id}', [HomeController::class, 'add_cart'])->middleware('user');
Route::get('/show_cart', [HomeController::class, 'show_cart'])->middleware('user');
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart'])->middleware('user');

Route::get('/cash_order', [HomeController::class, 'cash_order'])->middleware('user');
Route::get('/epay_order', [HomeController::class, 'epay_order'])->middleware('user');

Route::get('/view_order', [AdminController::class, 'view_order'])->middleware('admin');

Route::get('/delivered/{id}', [AdminController::class, 'delivered'])->middleware('admin');

Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf'])->middleware('admin');

Route::get('/search', [AdminController::class, 'searchdata'])->middleware('admin');

Route::get('/show_order', [HomeController::class, 'show_order'])->middleware('user');
Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order'])->middleware('user');

Route::get('/product_search', [HomeController::class, 'product_search']);

Route::get('/search_product', [HomeController::class, 'search_product']);

Route::get('/products', [HomeController::class, 'products']);

Route::get('/show_wishlist', [HomeController::class, 'show_wishlist'])->middleware('user');
Route::post('/add_wishlist/{id}', [HomeController::class, 'add_wishlist'])->middleware('user');
Route::get('/remove_wishlist/{id}', [HomeController::class, 'remove_wishlist'])->middleware('user');
