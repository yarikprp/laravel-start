<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('articles', ArticleController::class)
->except(['show']);
