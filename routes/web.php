<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    // return redirect('orders');
    return redirect('login');
});
Route::group(['middleware' => ['auth']], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('category','App\Http\Controllers\CategoryController');
Route::get('/category/{id}/delete', [App\Http\Controllers\CategoryController::class, 'destroy']);
Route::resource('products','App\Http\Controllers\ProductController');
Route::get('/getProducts',[App\Http\Controllers\ProductController::class,'getProducts']);
Route::get('/products/{id}/delete', [App\Http\Controllers\ProductController::class, 'destroy']);
Route::resource('tables','App\Http\Controllers\TableController');
Route::get('/tables/{id}/delete', [App\Http\Controllers\TableController::class, 'destroy']);
Route::resource('employees','App\Http\Controllers\EmployeeController');
Route::get('/employees/{id}/delete', [App\Http\Controllers\EmployeeController::class, 'destroy']);
Route::resource('orders','App\Http\Controllers\OrderController');
Route::get('/orders/{id}/delete', [App\Http\Controllers\OrderController::class, 'destroy']);
Route::post('/orders/update-order-status/{id}', [App\Http\Controllers\OrderController::class, 'updateStatus']);
Route::post('/orders/update-invoice-order-status/{id}', [App\Http\Controllers\OrderController::class, 'updateInvoiceStatus']);
Route::post('/orders/insert-new-record', [App\Http\Controllers\POSController::class, 'insertNewRecord']);
Route::post('/orders/customers/{id}', [App\Http\Controllers\POSController::class, 'CustomerStore']);

Route::get('/kot', [App\Http\Controllers\OrderController::class, 'getKot']);
Route::post('/orders/{id}/kot', [App\Http\Controllers\OrderController::class, 'updateKot']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Auth::routes();
