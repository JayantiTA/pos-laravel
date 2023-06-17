<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'getUsers']);
Route::get('/admin/user/create', [App\Http\Controllers\UserController::class, 'createUserPage']);
Route::post('/admin/user/create', [App\Http\Controllers\UserController::class, 'createUser']);
Route::get('/admin/user/edit/{id}', [App\Http\Controllers\UserController::class, 'editUserPage']);
Route::post('/admin/user/update', [App\Http\Controllers\UserController::class, 'updateUser']);
Route::post('/admin/user/delete/{id}', [App\Http\Controllers\UserController::class, 'deleteUser']);

Route::get('/admin/categories', [App\Http\Controllers\CategoryController::class, 'getCategories']);
Route::get('/admin/category/create', [App\Http\Controllers\CategoryController::class, 'createCategoryPage']);
Route::post('/admin/category/create', [App\Http\Controllers\CategoryController::class, 'createCategory']);
Route::get('/admin/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'editCategoryPage']);
Route::post('/admin/category/update', [App\Http\Controllers\CategoryController::class, 'updateCategory']);
Route::post('/admin/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'deleteCategory']);

Route::get('/admin/products', [App\Http\Controllers\ProductController::class, 'getProducts']);
Route::get('/admin/product/create', [App\Http\Controllers\ProductController::class, 'createProductPage']);
Route::post('/admin/product/create', [App\Http\Controllers\ProductController::class, 'createProduct']);
Route::get('/admin/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'editProductPage']);
Route::post('/admin/product/update', [App\Http\Controllers\ProductController::class, 'updateProduct']);
Route::post('/admin/product/delete/{id}', [App\Http\Controllers\ProductController::class, 'deleteProduct']);

Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'getTransactions']);
Route::post('/transaction/create', [App\Http\Controllers\TransactionController::class, 'createTransaction']);
Route::get('/transaction/{id}', [App\Http\Controllers\TransactionController::class, 'getTransaction']);

Route::post('/item/add', [App\Http\Controllers\ItemController::class, 'addItem']);
Route::get('/item/delete/{id}', [App\Http\Controllers\ItemController::class, 'deleteItem']);

Route::get('/checkout', [App\Http\Controllers\TransactionController::class, 'createTransactionPage']);
Route::post('/report', [App\Http\Controllers\TransactionController::class, 'getTransactionsByMonth']);
