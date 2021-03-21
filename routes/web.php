<?php

use Illuminate\Support\Facades\Route;


// Admin Controller
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;


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
    return view('admin.login');
});

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    return 'DONE'; //Return anything
});

Route::get('/routeList', function () {
    $exitCode = Artisan::call('route:list');
    return Artisan::output(); //Return anything
});

Route::get('/seed', function () {
    $exitCode = Artisan::call('db:seed');
    return 'DONE'; //Return anything
});


Route::prefix('admin')->name('admin.')->group(function() {
    // Admin Authentication Route
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::resource('/category', CategoryController::class);
    Route::post('/get-category', [CategoryController::class, 'getCategory'])->name('get.category');
    Route::post('/category/update', [CategoryController::class, 'updateCategory']);
    Route::resource('/sub-category', SubCategoryController::class);
    Route::post('/get-sub-category', [SubCategoryController::class, 'getSubCategory'])->name('get.sub-category');
    Route::post('/sub-category/update', [SubCategoryController::class, 'updateSubCategory']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
