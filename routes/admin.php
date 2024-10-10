<?php

use App\Http\Controllers\Dashboard\Admin\ProfileController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\ReservationController;
use App\Http\Controllers\Dashboard\User\DoctorController;
use App\Http\Controllers\Dashboard\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('test-email',function (){
    return view('emails.otp-message');
});

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

//    Route::redirect('/', 'admin/home');
    Route::redirect('admin', 'admin/home');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login_form');
        Route::post('login', [LoginController::class, 'login'])->name('login');
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('home', [HomeController::class, 'index'])->middleware('auth')->name('index');

        //Profile Routes
        Route::group(['prefix' => 'profile','middleware' => 'auth'], function () {
            Route::get('', [ProfileController::class, 'index'])->name('profile.index');
            Route::post('update', [ProfileController::class, 'update'])->name('profile.update');
            Route::group(['prefix' => 'changePassword'], function () {
                Route::get('', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
                Route::post('update', [ProfileController::class, 'updatePassword'])->name('profile.changePassword.update');
            });
        });
        Route::group(['prefix' => 'customers','middleware' => 'auth', 'as' => 'customers.'], function () {
            Route::get('', [UserController::class, 'index'])->name('index');
            Route::get('/{user}', [UserController::class, 'show'])->name('show');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });
        Route::group(['prefix' => 'doctors','middleware' => 'auth', 'as' => 'doctors.'], function () {
            Route::get('', [DoctorController::class, 'index'])->name('index');
            Route::get('/{user}', [DoctorController::class, 'show'])->name('show');
            Route::post('/{user}/change-status', [DoctorController::class, 'changeStatus'])->name('change_status');
            Route::delete('/{user}', [DoctorController::class, 'destroy'])->name('destroy');
        });
        Route::resource('reservations',ReservationController::class)->middleware('auth');
    });
});
