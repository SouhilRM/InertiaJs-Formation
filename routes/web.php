<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\linstingController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\RealtorListingController;

//la phase de test
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/show', [IndexController::class, 'show'])->name('index.show');
Route::get('/test', [IndexController::class, 'test'])->name('index.test');

//les routes des listings
Route::get('/index', [linstingController::class, 'index'])->name('listing.index');
Route::get('/listingShow/{listing}', [linstingController::class, 'show'])->name('listing.show');

//les routes d'authentification
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login/store', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'logout'])->name('logout');

//les routes register
Route::get('register', [UserAccountController::class, 'register'])->name('register');
Route::post('register/store', [UserAccountController::class, 'store'])->name('register.store');

//les routes de l'agent immobilier
Route::prefix('realtor')->middleware('auth')->group(function () {
    Route::get('index', [RealtorListingController::class, 'index'])->name('realtor.index');

    Route::delete('listing/delete/{listing}', [RealtorListingController::class, 'delete'])->name('realtor.listing.delete');

    Route::get('/listingEdit/{listing}', [RealtorListingController::class, 'edit'])->name('realtor.listing.edit');

    Route::post('/listingUpdate/{listing}', [RealtorListingController::class, 'update'])->name('realtor.listing.update');

    Route::get('/listingCreate', [RealtorListingController::class, 'create'])->name('realtor.listing.create');

    Route::post('/listingStore', [RealtorListingController::class, 'store'])->name('realtor.listing.store');

    //n'oublie pas le "->withTrashed()" dans ta route sinon il ne va pas trouver le model
    Route::put('listingRestore/{listing}', [RealtorListingController::class, 'toto'])->withTrashed()->name('realtor.listing.restore');
});