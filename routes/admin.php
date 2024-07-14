<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Question\CategoryController as QuestionCategoryController;
use App\Http\Controllers\Admin\Question\ModelController as QuestionModelController;
use App\Http\Controllers\Admin\Question\SubjectCategoryController as QuestionSubjectCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\SubFacultyController;
use App\Http\Controllers\Admin\SubjectController;
use Illuminate\Support\Facades\Route;

Route::resource('/dashboard', DashboardController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/level', LevelController::class);
Route::resource('/faculty', FacultyController::class);
Route::resource('/sub-faculty', SubFacultyController::class);
Route::resource('/subject', SubjectController::class);
Route::prefix('question')->name('question.')->group(function() {
    Route::resource('category', QuestionCategoryController::class);
    Route::resource('model', QuestionModelController::class);
    Route::delete('subject/{subject}/category/{category}', [QuestionSubjectCategoryController::class, 'delete'])->name('subject.category.destroy');
    Route::resource('subject.category', QuestionSubjectCategoryController::class)->except('delete');
});

Route::get('/api/category/{categoryId}/levels', [LevelController::class, 'levelsByCategory']);
Route::get('/api/level/{levelId}/faculties', [FacultyController::class, 'facultiesByLevel']);
Route::get('/api/faculty/{facultyId}/sub-faculties', [SubFacultyController::class, 'subFacultiesByFaculty']);
