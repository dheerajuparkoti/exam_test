<?php
// Controllers for Users
use App\Http\Controllers\Users\DashboardPageController;
use App\Http\Controllers\Users\ExamPageController;
use App\Http\Controllers\Users\LibraryPageController;
use App\Http\Controllers\Users\HallPageController;
use App\Http\Controllers\Users\AboutPageController;
use Illuminate\Support\Facades\Route;



//For USERS
// Group routes for DashboardPage
Route::group(['prefix' => 'dashboard', 'namespace' => 'users'], function () {
    Route::get('/', [DashboardPageController::class, 'index'])->name('dashboard.index');
});


// Group routes for ExamPage
Route::group(['prefix' => 'exam', 'namespace' => 'users'], function () {
    Route::get('/', [ExamPageController::class, 'index'])->name('exam.index');
    Route::get('/exam-form', [ExamPageController::class, 'form'])->name('exam.form');
});


// Group routes for LibraryPage
Route::group(['prefix' => 'library', 'namespace' => 'users'], function () {
    Route::get('/', [LibraryPageController::class, 'index'])->name('library.index');
});

// Group routes for HallPage
Route::group(['prefix' => 'hall', 'namespace' => 'users'], function () {
    Route::get('/', [HallPageController::class, 'index'])->name('hall.index');
});

// Group routes for AboutPage
Route::group(['prefix' => 'about', 'namespace' => 'users'], function () {
    Route::get('/', [AboutPageController::class, 'index'])->name('about.index');
});

//END FOR USERS ==============================================================
Route::get('/', function () {
    return view('users.exam.form');
});
