<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QsnModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Faculty;
use App\Models\Level;


use App\Models\History;

class HistoryPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        if (!$userId) {
           
            return redirect()->route('login');
        }

      
        $modelIds = History::where('user_id', $userId)
                            ->pluck('qsn_model_id')
                            ->unique();

        
        $qsnModels = QsnModel::whereIn('id', $modelIds)->get();

   // Chart-1 Marks Vs. Model
        $labels = [];
        $fullMarks = [];
        $passMarks = [];
        $obtainedMarks = [];

        foreach ($qsnModels as $model) {
          
            $labels[] = $model->name;

          
            $history = History::where('user_id', $userId)
                               ->where('qsn_model_id', $model->id)
                               ->first();
            $obtainedMarks[] = $history ? $history->obtained_marks : 0;

          
            $fullMarks[] = $model->full_mark;
            $passMarks[] = $model->pass_mark;
        }




        //Chart-2 No. of Questions Vs.Model
        $questionData = [];
        foreach ($modelIds as $modelId) {
            $model = $qsnModels->where('id', $modelId)->first();
            $historiesForModel = History::where('user_id', $userId)
                                        ->where('qsn_model_id', $modelId)
                                        ->get();

            $totalQuestions = $historiesForModel->sum('total_qsn');
            $answeredQuestions = $historiesForModel->sum('answered_qsn');
            $skippedQuestions = $historiesForModel->sum('skipped_qsn');
            $correctAnswers = $historiesForModel->sum('correct_count');
            $mistakeAnswers = $answeredQuestions - $correctAnswers;

            $questionData[$model->name] = [
                'total_questions' => $totalQuestions,
                'answered_questions' => $answeredQuestions,
                'skipped_questions' => $skippedQuestions,
                'correct_answers' => $correctAnswers,
                'mistake_answers' => $mistakeAnswers
            ];
        }

        $chartLabels = array_keys($questionData);
        $totalQuestionsData = array_column($questionData, 'total_questions');
        $answeredQuestionsData = array_column($questionData, 'answered_questions');
        $skippedQuestionsData = array_column($questionData, 'skipped_questions');
        $correctAnswersData = array_column($questionData, 'correct_answers');
        $mistakeAnswersData = array_column($questionData, 'mistake_answers');

        // Chart -3 No.of Practiced Models Vs. Month

 $monthlyData = History::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(DISTINCT qsn_model_id) as model_count')
 ->where('user_id', $userId)
 ->groupBy('month')
 ->orderBy('month')
 ->get();

$months = $monthlyData->pluck('month')->toArray();
$modelCounts = $monthlyData->pluck('model_count')->toArray();

// Chart-4 Line Chart Highest Obtained Marks Vs. week progress analysis  
 // Extract weekly data for the fourth chart
 $weeklyData = History::select(DB::raw('WEEK(created_at) as week'), DB::raw('YEAR(created_at) as year'), DB::raw('MAX(obtained_marks) as max_obtained_marks'))
 ->where('user_id', $userId)
 ->groupBy(DB::raw('WEEK(created_at), YEAR(created_at)'))
 ->orderBy(DB::raw('YEAR(created_at)'))
 ->orderBy(DB::raw('WEEK(created_at)'))
 ->get();

// Prepare data for the weekly chart
$weeks = $weeklyData->map(function($data) {
 return $data->year . ' - Week ' . $data->week;
})->toArray();

$maxObtainedMarks = $weeklyData->pluck('max_obtained_marks')->toArray();

// Chart-5 Pie Chart Category Distribution
// Get category counts based on model IDs
$categoryCounts = QsnModel::whereIn('qsn_models.id', $modelIds)
    ->join('categories as cat', 'qsn_models.category_id', '=', 'cat.id')
    ->select('cat.name', DB::raw('COUNT(qsn_models.id) as count'))
    ->groupBy('cat.name')
    ->get();

// Extract all category names from the categories table
$allCategories = Category::all()->pluck('name', 'id');

// Initialize the category counts array
$categoryCountsMap = $categoryCounts->pluck('count', 'name')->toArray();

// Prepare data for the pie chart
$finalCategoryNames = $allCategories->values(); // Category names for the pie chart
$finalCategoryCounts = $allCategories->map(function ($name, $id) use ($categoryCountsMap) {
    // Match category names with counts
    return $categoryCountsMap[$name] ?? 0;
})->values(); // Ensure counts are in the same order as names


// Chart-6  Level Distribution 
// Get Level counts based on model IDs
$levelCounts = QsnModel::whereIn('qsn_models.id', $modelIds)
    ->join('levels as lvl', 'qsn_models.level_id', '=', 'lvl.id')
    ->select('lvl.name', DB::raw('COUNT(qsn_models.id) as count'))
    ->groupBy('lvl.name')
    ->get();


$allLevels = Level::all()->pluck('name', 'id');

// Initialize the category counts array
$levelCountsMap = $levelCounts->pluck('count', 'name')->toArray();

// Prepare data for the pie chart
$finalLevelNames = $allLevels->values(); // Category names for the pie chart
$finalLevelCounts = $allLevels->map(function ($name, $id) use ($levelCountsMap) {
    // Match category names with counts
    return $levelCountsMap[$name] ?? 0;
})->values(); // Ensure counts are in the same order as names




// Chart-7  Faculty Distribution

$facultyCounts = QsnModel::whereIn('qsn_models.id', $modelIds)
    ->join('faculties as fac', 'qsn_models.faculty_id', '=', 'fac.id')
    ->select('fac.name', DB::raw('COUNT(qsn_models.id) as count'))
    ->groupBy('fac.name')
    ->get();


    $allFaculties = Faculty::whereNull('parent_id')->pluck('name', 'id');


// Initialize the category counts array
$facultyCountsMap = $facultyCounts->pluck('count', 'name')->toArray();

// Prepare data for the pie chart
$finalFacultyNames = $allFaculties->values(); // Category names for the pie chart
$finalFacultyCounts = $allFaculties->map(function ($name, $id) use ($facultyCountsMap) {
    // Match category names with counts
    return $facultyCountsMap[$name] ?? 0;
})->values(); // Ensure counts are in the same order as names





// Chart-8  Sub-Faculty Distribution

$subFacultyCounts = QsnModel::whereIn('qsn_models.id', $modelIds)
    ->join('faculties as subFac', 'qsn_models.sub_faculty_id', '=', 'subFac.id')
    ->select('subFac.name', DB::raw('COUNT(qsn_models.id) as count'))
    ->groupBy('subFac.name')
    ->get();


$allSubFaculties = Faculty::whereNotNull('parent_id')->pluck('name', 'id');


// Initialize the category counts array
$subFacultyCountsMap = $subFacultyCounts->pluck('count', 'name')->toArray();

// Prepare data for the pie chart
$finalSubFacultyNames = $allSubFaculties->values(); // Category names for the pie chart
$finalSubFacultyCounts = $allSubFaculties->map(function ($name, $id) use ($subFacultyCountsMap) {
    // Match category names with counts
    return $subFacultyCountsMap[$name] ?? 0;
})->values(); // Ensure counts are in the same order as names



return view('users.history.index', compact(
    'labels', 'fullMarks', 'passMarks', 'obtainedMarks',//chart-1
    'chartLabels', 'totalQuestionsData', 'answeredQuestionsData', 
    'skippedQuestionsData', 'correctAnswersData', 'mistakeAnswersData',//chart-3
    'months', 'modelCounts', //Chart-3
    'weeks', 'maxObtainedMarks', //Chart-4
     'finalCategoryNames', 'finalCategoryCounts',//Chart-5 pie chart
     'finalLevelNames','finalLevelCounts',// Chart -6 
     'finalFacultyNames','finalFacultyCounts',// Chart -7 
     'finalSubFacultyNames','finalSubFacultyCounts'// Chart -8
));
    }
}