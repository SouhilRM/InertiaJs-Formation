<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\linstingController;
use App\Http\Controllers\UserAccountController;

//la phase de test
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/show', [IndexController::class, 'show'])->name('index.show');
Route::get('/test', [IndexController::class, 'test'])->name('index.test');

//les routes des listings
Route::get('/index', [linstingController::class, 'index'])->name('listing.index');
Route::get('/listingShow/{listing}', [linstingController::class, 'show'])->name('listing.show');//n'oublie pas l'id listing
Route::get('/create', [linstingController::class, 'create'])->name('listing.create')->middleware('auth');
Route::post('/store', [linstingController::class, 'store'])->name('listing.store')->middleware('auth');
Route::get('/listingEdit/{listing}', [linstingController::class, 'edit'])->name('listing.edit')->middleware('auth');
Route::post('/update/{listing}', [linstingController::class, 'update'])->name('listing.update')->middleware('auth');
Route::delete('/listingDelete/{listing}', [linstingController::class, 'delete'])->name('listing.delete')->middleware('auth');

//les routes d'authentification
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login/store', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'logout'])->name('logout');

//les routes register
Route::get('register', [UserAccountController::class, 'register'])->name('register');
Route::post('register/store', [UserAccountController::class, 'store'])->name('register.store');