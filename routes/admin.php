<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::resource('/dashboard', DashboardController::class);
Route::resource('/category', CategoryController::class);
