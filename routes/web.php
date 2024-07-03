<?php

use App\Http\Controllers\Pages\ExamPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('users.dashboard.index');
});


Route::get('/exam-page', [ExamPageController::class, 'index'])->name('exam-page');