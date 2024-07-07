<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\SubFacultyController;
use Illuminate\Support\Facades\Route;

Route::resource('/dashboard', DashboardController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/level', LevelController::class);
Route::resource('/faculty', FacultyController::class);
Route::resource('/sub-faculty', SubFacultyController::class);


Route::get('/api/category/{categoryId}/levels', [LevelController::class, 'levelsByCategory']);
Route::get('/api/level/{levelId}/faculties', [FacultyController::class, 'facultiesByLevel']);
