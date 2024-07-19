<?php
// Controllers for Users
use App\Http\Controllers\Users\DashboardPageController;
use App\Http\Controllers\Users\AuthController;
// for exam page data loading
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LevelController;
use App\Http\Controllers\Users\FacultyController;
use App\Http\Controllers\Users\QsnCategoryController;
use App\Http\Controllers\Users\QsnModelController;
use App\Http\Controllers\Users\SubjectQsnCategoryController;
use App\Http\Controllers\Users\SubjectController;

use App\Http\Controllers\Users\QuestionsController;
use App\Http\Controllers\Users\ExamPageController;
use App\Http\Controllers\Users\LibraryPageController;
use App\Http\Controllers\Users\HallPageController;
use App\Http\Controllers\Users\AboutPageController;
use App\Models\QsnModel;
use Illuminate\Support\Facades\Route;



//For USERS
// Group routes for DashboardPage
Route::group(['prefix' => 'dashboard', 'namespace' => 'users'], function () {
    Route::get('/', [DashboardPageController::class, 'index'])->name('dashboard.index');
});


// Group routes for ExamPage
Route::group(['prefix' => 'exam', 'namespace' => 'Users'], function () {
    Route::get('/exam-form', [ExamPageController::class, 'index'])->name('exam.index');
    Route::get('/categories/{category}/levels', [LevelController::class, 'getLevelsByCategory'])->name('categories.levels');
    Route::get('/categories/{category}/faculties', [FacultyController::class, 'getFacultiesByCategory'])->name('categories.faculties');
    Route::get('/faculties/{faculty}/sub-faculties', [FacultyController::class, 'getSubFacultiesByFaculty'])->name('faculties.subFaculties');
    Route::get('/sub-faculties/{subFaculty}/subjects', [SubjectController::class, 'getSubjectsBySubFaculty'])->name('subFaculties.subjects');
    Route::get('/qsnCategories/{subject}/qsn_types', [QsnCategoryController::class, 'getQsnTypeBySubject'])->name('subjects.QsnType');

    Route::get('/exam-room', [ExamPageController::class, 'loadRoom'])->name('exam.room');
    Route::get('/exam-room/random/{qsn_model_id}', [ExamPageController::class, 'getRandomQuestions'])->name('load.questions');
    Route::get('/exam-form/models', [QsnModelController::class, 'getModels'])->name('question.models');
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
    return view('users.loginpage');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');