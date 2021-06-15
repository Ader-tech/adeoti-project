<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/store',[CategoryController::class, 'index']);
// Route::post('/create-category',[CategoryController::class, 'create']);
// Route::post('/update-Category/{id}', [CategoryController::class, 'update']);
// Route::get('/get-all-categories', [CategoryController::class, 'allCategories']);
// Route::get('/get-category-withproduct', [CategoryController::class, 'product']);
// Route::get('/get-category-products/{id}', [CategoryController::class, 'getSingleCategoryProducts']);
// Route::post('/get-one-category/{id}', [CategoryController::class, 'getSingleCategory']);

// Route::get('/get-all-products', [ProductController::class, 'allProducts']);
// Route::post('/create-product', [ProductController::class, 'create']);
// Route::post('/update-product/{id}', [ProductController::class, 'update']);
// Route::post('/get-one-product/{id}', [ProductController::class, 'getSingleProduct']);
// Route::get('/getp', [ProductController::class, 'getProduct']);


// Route::get('/get-all-orders', [OrderController::class, 'allOrder']);
// Route::post('/create-order', [OrderController::class, 'create']);
// Route::post('/update-order/{id}', [OrderController::class, 'update']);
// Route::post('/count-order', [OrderController::class, 'count']);
// Route::post('/get-one-order/{id}', [OrderController::class, 'getSingleOrder']);

// Route::post('/create-client', [ClientController::class, 'create']);
// Route::post('/update-client/{id}', [ClientController::class, 'update']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
