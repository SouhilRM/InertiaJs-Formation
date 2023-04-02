<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\linstingController;


Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);
Route::get('/test', [IndexController::class, 'test']);

Route::get('/index', [linstingController::class, 'index']);
Route::get('/listingShow/{listing}', [linstingController::class, 'show']);//n'oublie pas l'id listing

