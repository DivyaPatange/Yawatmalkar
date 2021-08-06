<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartController;

// Admin Controller
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BannerImageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\FlashesController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\ScheduleController;

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserScheduleController;
use App\Http\Controllers\User\ChangePasswordController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ItemController;

use App\Http\Controllers\DesignController;

use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\Auth\CustomerController;
use App\Http\Controllers\Auth\CustomerRegisterController;
use App\Http\Controllers\Customer\OrderController;

use App\Http\Controllers\GoogleController;

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
    return view('frontEnd.index');
});

Route::get('beauty', function () {
    return view('frontEnd.beauty');
});

Route::get('doctors', function () {
    return view('frontEnd.doctors');
});
Route::get('dailyneeds', function () {
    return view('frontEnd.dailyneeds');
});
Route::get('electricals', function () {
    return view('frontEnd.electricals');
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

Route::get('/cart', function(){
    $cartCollection = \Cart::getContent();
    return view('frontEnd.cart', compact('cartCollection'));
});

Route::prefix('customer')->name('customer.')->group(function() {
    // Admin Authentication Route
    Route::get('/login', [CustomerLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CustomerLoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [CustomerRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [CustomerRegisterController::class, 'register'])->name('register.submit');
    Route::get('/', [CustomerController::class, 'index'])->name('dashboard');
    Route::get('/logout', [CustomerLoginController::class, 'logout'])->name('logout');
    Route::post('/placeOrder', [OrderController::class, 'placedOrder'])->name('placed.order');
    Route::get('/orderDetails/{id}', [OrderController::class, 'orderDetails'])->name('order.details');
    Route::get('/save-customer-info', [OrderController::class, 'saveCustomerInfo'])->name('save-customer-info');
    Route::post('/payment/{id}', [OrderController::class, 'payment'])->name('payment');
    Route::post('/success', [OrderController::class, 'paymentSuccess'])->name('success');
    Route::get('/payment-success/{id}', [OrderController::class, 'paymentDetail'])->name('payment-success');
});
Auth::routes();

// Socialite Route
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
    Route::resource('/register', RegisterController::class);
    Route::post('/registers/upload-document', [RegisterController::class, 'uploadDocument'])->name('register.upload-document');
    Route::post('/registers/general-info', [RegisterController::class, 'saveGeneralInfo'])->name('register.general-info');
    Route::get('/register/status/{id}', [RegisterController::class, 'status']);
    Route::get('/register/edit-document/{id}', [RegisterController::class, 'editDocument'])->name('register.edit-document');
    Route::put('/register/update-document/{id}', [RegisterController::class, 'updateDocument'])->name('register.update-document');

    Route::get('get-subcategory-list', [SubCategoryController::class, 'getSubCategoryList']);
    Route::get('get-users-list', [SubCategoryController::class, 'getUserList']);

    // User Schedule List
    Route::resource('/schedule-data', ScheduleController::class);
    Route::get('/schedule-data/status/{id}', [ScheduleController::class, 'status']);

    // Banner Image Route
    Route::resource('/banner-image', BannerImageController::class);
    Route::post('/get-banner-image', [BannerImageController::class, 'getBannerImage'])->name('get.banner-image');
    Route::post('/banner-image/update', [BannerImageController::class, 'updateBannerImage']);

    Route::resource('/testimonials', TestimonialController::class);
    Route::resource('/flashes-upcoming', FlashesController::class);
    Route::post('/get-flashes-upcoming', [FlashesController::class, 'getFlashesUpcoming'])->name('get.flashes-upcoming');
    Route::post('/flashes-upcoming/update', [FlashesController::class, 'updateFlashesUpcoming']);

    Route::resource('/products', App\Http\Controllers\Admin\ProductController::class);
});


Route::get('/get-subcategory-list', [DesignController::class, 'getSubcategoryList']);
Route::get('/{id}', [DesignController::class, 'getCategoryPage']);
Route::get('/products-services/{id}', [DesignController::class, 'getProductServices'])->name('products-services');

// Cart Route
Route::post('/add', [CartController::class, 'add'])->name('cart.store');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::prefix('user')->name('user.')->group(function() {
    Route::resource('/profile', ProfileController::class);
    Route::post('profile-details/{id}', [ProfileController::class, 'updateDetails'])->name('profile.update-details');
    Route::post('update-time/{id}', [ProfileController::class, 'updateWorkingHour'])->name('profile.update-time');
    Route::post('add-working-time', [ProfileController::class, 'addWorkingTime'])->name('add-working-time');
    Route::delete('delete-working-time/{id}', [ProfileController::class, 'deleteWorkingTime'])->name('delete-working-time');
    Route::get('get-subcategory-list', [ProfileController::class, 'getSubCategoryList']);
    Route::resource('/schedule', UserScheduleController::class);
    Route::get('/schedule/status/{id}', [UserScheduleController::class, 'status']);
    Route::post('/get-schedule', [UserScheduleController::class, 'getSchedule'])->name('get.schedule');
    Route::post('/schedule/update', [UserScheduleController::class, 'updateSchedule']);
    Route::get('/schedule/get-list', [UserScheduleController::class, 'getList'])->name('schedule.getList');
    Route::resource('change-password', ChangePasswordController::class);

    // Item Route
    Route::resource('items', ItemController::class);
    Route::post('/get-item', [ItemController::class, 'getItem'])->name('get.item');
    Route::post('/items/update', [ItemController::class, 'updateItem']);

    // Product Route
    Route::resource('/products', ProductController::class);
    Route::get('get-items-list', [ItemController::class, 'getItemList']);
});

