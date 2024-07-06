<?php
// Controllers for Users
use App\Http\Controllers\Users\DashboardPageController;
// for exam page data loading
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LevelController;
use App\Http\Controllers\Users\FacultyController;
use App\Http\Controllers\Users\ProgramsController;
use App\Http\Controllers\Users\QsnCategoryController;
use App\Http\Controllers\Users\SubjectQsnCategoryController;
use App\Http\Controllers\Users\SubjectsController;
use App\Http\Controllers\Users\QuestionsController;
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
Route::group(['prefix' => 'exam', 'namespace' => 'Users'], function () {
    Route::get('/exam-form', [CategoryController::class, 'index'])->name('exam.index');
    Route::get('/categories/{category}/levels', [LevelController::class, 'getLevelsByCategory'])->name('categories.levels');
    Route::get('/categories/{category}/faculties', [FacultyController::class, 'getFacultiesByCategory'])->name('categories.faculties');
    Route::get('/faculties/{faculty}/programs', [ProgramsController::class, 'getProgramsByFaculty'])->name('faculties.programs');
    Route::get('/programs/{program}/subjects', [SubjectsController::class, 'getSubjectsByProgram'])->name('programs.subjects');
    Route::get('/qsnCategories/{subject}/qsn_types', [QsnCategoryController::class, 'getQsnTypeBySubject'])->name('subjects.QsnType');

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
    return view('users.exam.index');
});
