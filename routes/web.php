<?php

use App\Http\Controllers\AdifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AwardController;

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
// login socialite
// Route::get('/auth/{provider}', [AuthController::class, 'redirectProvider'])->name('redirect.provider');
// Route::get('/google/callback', [AuthController::class, 'callbackGoogle'])->name('google.callback');
// Route::get('/facebook/callback', [AuthController::class, 'callbackFacebook'])->name('facebook.callback');

// auth frontend
// Route::post('/loginUser', [AuthController::class, 'login'])->name('login.user');
// Route::post('/signupUser', [AuthController::class, 'signup'])->name('signup.user');

// frontend
// Route::get('/', [HomeController::class, 'index']);
// Route::get('/home', [HomeController::class, 'index'])->name('home');


// route middleware
// Route::middleware(['auth', 'user'])->group(function () {

//     Route::post('/adif/upload', [AdifController::class, 'upload'])->name('adif.upload');

//     Route::get('/award', [AwardController::class, 'index'])->name('award.index');

//     // account
//     Route::prefix('account')->group(function () {
//         Route::get('/profile', [AccountController::class, 'index']);
//         Route::post('/save', [AccountController::class, 'save'])->name('account.save');
//     });
// });


// backend

Route::get('/', function () {
    return redirect('adif');
});

Route::get('/admin', function() {
    return redirect('adif');
});

Route::middleware(['auth'])
->group(function () {

    // adif
    Route::prefix('adif')->group(function () {
        Route::get('/', [AdifController::class, 'index']);
        Route::post('/upload', [AdifController::class, 'upload'])->name('adif.upload');
    });

    // profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
    });

    // award
    Route::prefix('award')->group(function () {
        Route::get('/', [AwardController::class, 'index']);
        Route::post('/sync', [AwardController::class, 'sync'])->name('award.sync');
    });
});
