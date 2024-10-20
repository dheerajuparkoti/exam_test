<?php
// Controllers for Users
use App\Http\Controllers\Users\DashboardPageController;
use App\Http\Controllers\Users\AuthController;
use Illuminate\Support\Facades\Auth;
// for exam page data loading
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LevelController;
use App\Http\Controllers\Users\FacultyController;
use App\Http\Controllers\Users\QsnCategoryController;
use App\Http\Controllers\Users\QsnModelController;
use App\Http\Controllers\Users\SubjectQsnCategoryController;
use App\Http\Controllers\Users\SubjectController;
use App\Http\Controllers\Users\HistoryPageController;

use App\Http\Controllers\Users\QuestionsController;
use App\Http\Controllers\Users\ExamPageController;
use App\Http\Controllers\Users\LibraryPageController;
use App\Http\Controllers\Users\HallPageController;
use App\Http\Controllers\Users\AboutPageController;
use App\Models\QsnModel;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Users\OldSetController;



// Public routes
Route::get('/', function () {
    // Redirect to dashboard if the user is authenticated
    if (Auth::check()) {
        return redirect()->route('dashboard.index');
    }
    // Show login page if the user is not authenticated
    return view('users.loginpage');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('/register', [AuthController::class, 'store'])->name('user.register');


// Registration Route
Route::post('/register', [AuthController::class, 'store'])->name('user.register');

// Handle the verification code submission
Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('verify.code.submit');



// For USERS - Protected Routes
// Group routes for DashboardPage
Route::group(['prefix' => 'dashboard', 'namespace' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/', [DashboardPageController::class, 'index'])->name('dashboard.index');
});

//old sets
Route::group(['prefix' => 'oldsets', 'namespace' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/old-sets', [OldSetController::class, 'index'])->name('oldsets.index');
    Route::get('/old-sets/search', [OldSetController::class, 'search'])->name('oldsets.search');
});



// Group routes for ExamPage
Route::group(['prefix' => 'exam', 'namespace' => 'Users', 'middleware' => ['auth']], function () {
    Route::get('/exam-form', [ExamPageController::class, 'index'])->name('exam.index');
    Route::get('/categories/{category}/levels', [LevelController::class, 'getLevelsByCategory'])->name('categories.levels');
    Route::get('/categories/{category}/faculties', [FacultyController::class, 'getFacultiesByCategory'])->name('categories.faculties');
    Route::get('/faculties/{faculty}/sub-faculties', [FacultyController::class, 'getSubFacultiesByFaculty'])->name('faculties.subFaculties');
    Route::get('/sub-faculties/{subFaculty}/subjects', [SubjectController::class, 'getSubjectsBySubFaculty'])->name('subFaculties.subjects');
    Route::get('/qsnCategories/{subject}/qsn_types', [QsnCategoryController::class, 'getQsnTypeBySubject'])->name('subjects.QsnType');

    Route::post('/exam-room', [ExamPageController::class, 'loadRoom'])->name('exam.room');
    Route::get('/exam-room/random/{qsn_model_id}', [ExamPageController::class, 'getRandomQuestions'])->name('load.questions');
    Route::post('/exam-room/store', [ExamPageController::class, 'store'])->name('submit.quiz');
    Route::get('/exam-form/models', [QsnModelController::class, 'getModels'])->name('question.models');
    Route::get('/exam-form/models/distribution', [QsnModelController::class, 'distribution'])->name('question.models.distribution');
});

// Group routes for LibraryPage
Route::group(['prefix' => 'library', 'namespace' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/', [LibraryPageController::class, 'index'])->name('library.index');
});

// Group routes for HallPage
Route::group(['prefix' => 'history', 'namespace' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/', [HistoryPageController::class, 'index'])->name('history.index');
});

// Group routes for AboutPage
Route::group(['prefix' => 'about', 'namespace' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/', [AboutPageController::class, 'index'])->name('about.index');
});


