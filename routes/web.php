<?php

use Illuminate\Support\Facades\Route;


// Admin Controller
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\LawyerController;
use App\Http\Controllers\Admin\BeauticianController;
use App\Http\Controllers\Admin\DoctorScheduleController;
use App\Http\Controllers\Admin\LawyerScheduleController;
use App\Http\Controllers\Admin\BeauticianScheduleController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\BannerImageController;
use App\Http\Controllers\Admin\TestimonialController;

use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserScheduleController;
use App\Http\Controllers\User\ChangePasswordController;

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
    Route::resource('/doctors', DoctorController::class);
    Route::get('get-subcategory-list', [DoctorController::class, 'getSubCategoryList']);
    Route::post('/doctors/upload-document', [DoctorController::class, 'uploadDocument'])->name('doctor.upload-document');
    Route::post('/doctors/general-info', [DoctorController::class, 'saveGeneralInfo'])->name('doctor.general-info');
    Route::get('/doctors/status/{id}', [DoctorController::class, 'status']);
    Route::get('/doctor/edit-document/{id}', [DoctorController::class, 'editDocument'])->name('doctors.edit-document');
    Route::put('/doctor/update-document/{id}', [DoctorController::class, 'updateDocument'])->name('doctors.update-document');

    Route::resource('/lawyers', LawyerController::class);
    Route::post('/lawyers/upload-document', [LawyerController::class, 'uploadDocument'])->name('lawyer.upload-document');
    Route::post('/lawyers/general-info', [LawyerController::class, 'saveGeneralInfo'])->name('lawyer.general-info');
    Route::get('/lawyers/status/{id}', [LawyerController::class, 'status']);
    Route::get('/lawyer/edit-document/{id}', [LawyerController::class, 'editDocument'])->name('lawyers.edit-document');
    Route::put('/lawyer/update-document/{id}', [LawyerController::class, 'updateDocument'])->name('lawyers.update-document');

    Route::resource('/beautician', BeauticianController::class);
    Route::post('/beautician/upload-document', [BeauticianController::class, 'uploadDocument'])->name('beautician.upload-document');
    Route::post('/beautician/general-info', [BeauticianController::class, 'saveGeneralInfo'])->name('beautician.general-info');
    Route::get('/beautician/status/{id}', [BeauticianController::class, 'status']);
    Route::get('/beautician/edit-document/{id}', [BeauticianController::class, 'editDocument'])->name('beautician.edit-document');
    Route::put('/beautician/update-document/{id}', [BeauticianController::class, 'updateDocument'])->name('beautician.update-document');

    Route::resource('/doctor-schedule', DoctorScheduleController::class);
    Route::get('/doctor-schedule/status/{id}', [DoctorScheduleController::class, 'status']);
    Route::post('/get-doctor-schedule', [DoctorScheduleController::class, 'getDoctorSchedule'])->name('get.doctor-schedule');
    Route::post('/doctor-schedule/update', [DoctorScheduleController::class, 'updateDoctorSchedule']);

    Route::resource('/lawyer-schedule', LawyerScheduleController::class);
    Route::get('/lawyer-schedule/status/{id}', [LawyerScheduleController::class, 'status']);
    Route::post('/get-lawyer-schedule', [LawyerScheduleController::class, 'getLawyerSchedule'])->name('get.lawyer-schedule');
    Route::post('/lawyer-schedule/update', [LawyerScheduleController::class, 'updateLawyerSchedule']);

    Route::resource('/beautician-schedule', BeauticianScheduleController::class);
    Route::get('/beautician-schedule/status/{id}', [BeauticianScheduleController::class, 'status']);
    Route::post('/get-beautician-schedule', [BeauticianScheduleController::class, 'getBeauticianSchedule'])->name('get.beautician-schedule');
    Route::post('/beautician-schedule/update', [BeauticianScheduleController::class, 'updateBeauticianSchedule']);

    Route::resource('/pages', PagesController::class);
    Route::post('/get-page', [PagesController::class, 'getPage'])->name('get.page');
    Route::post('/page/update', [PagesController::class, 'updatePage']);

    // Banner Image Route
    Route::resource('/banner-image', BannerImageController::class);
    Route::post('/get-banner-image', [BannerImageController::class, 'getBannerImage'])->name('get.banner-image');
    Route::post('/banner-image/update', [BannerImageController::class, 'updateBannerImage']);

    Route::resource('/testimonials', TestimonialController::class);;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('user')->name('user.')->group(function() {
    Route::resource('/profile', ProfileController::class);
    Route::get('get-subcategory-list', [ProfileController::class, 'getSubCategoryList']);
    Route::resource('/schedule', UserScheduleController::class);
    Route::get('/schedule/status/{id}', [UserScheduleController::class, 'status']);
    Route::post('/get-schedule', [UserScheduleController::class, 'getSchedule'])->name('get.schedule');
    Route::post('/schedule/update', [UserScheduleController::class, 'updateSchedule']);
    Route::get('/schedule/get-list', [UserScheduleController::class, 'getList'])->name('schedule.getList');
    Route::resource('change-password', ChangePasswordController::class);
});