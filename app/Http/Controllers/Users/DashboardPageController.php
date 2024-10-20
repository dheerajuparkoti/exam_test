<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\QsnModel;



class DashboardPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all histories for the logged-in user
        $histories = History::where('user_id', Auth::id())
                    ->with('qsnModel')  // Eager load the related qsn_models data
                    ->get();

        // Calculate total tests taken
        $totalTests = $histories->count();

        // Calculate the average score (as a percentage)
        $averageScore = $histories->map(function ($history) {
            return ($history->obtained_marks / $history->qsnModel->full_mark) * 100;
        })->average();

        // Calculate the highest score (as a percentage)
        $highestScore = $histories->map(function ($history) {
            return ($history->obtained_marks / $history->qsnModel->full_mark) * 100;
        })->max();

        // Calculate how many tests the user passed
        $testsPassed = $histories->filter(function ($history) {
            return $history->obtained_marks >= $history->qsnModel->pass_mark;
        })->count();


         // Prepare data for the test history table
    $testHistory = $histories->map(function ($history) {
        $scorePercentage = ($history->obtained_marks / $history->qsnModel->full_mark) * 100;
        $status = $history->obtained_marks >= $history->qsnModel->pass_mark ? 'Passed' : 'Failed';

        return [
            'test_name' => $history->qsnModel->name, // Adjust field as necessary
            'date_taken' => $history->created_at->format('F j, Y'), // Format the date
            'score' => number_format($scorePercentage, 2) . '%',
            'status' => $status,
        ];
    });

 // Fetch top scores for the leaderboard
 $topScores = History::select('user_id', DB::raw('MAX(obtained_marks) as highest_marks'))
 ->join('qsn_models', 'histories.qsn_model_id', '=', 'qsn_models.id')
 ->groupBy('user_id')
 ->orderBy('highest_marks', 'desc')
 ->take(5) // Adjust the number of top scores you want to show
 ->get()
 ->map(function ($item) {
     return [
         'user_id' => $item->user_id,
         'highest_marks' => $item->highest_marks,
     ];
 });

// Fetch user names for the top scores
$leaderboard = $topScores->map(function ($score) {
 $user = User::find($score['user_id']);
 $qsnModel = QsnModel::whereHas('histories', function ($query) use ($user, $score) {
     $query->where('user_id', $user->id)
           ->where('obtained_marks', $score['highest_marks']);
 })->first();
 
 $scorePercentage = $qsnModel ? ($score['highest_marks'] / $qsnModel->full_mark) * 100 : 0;

 return [
     'name' => $user->name,
     'score' => number_format($scorePercentage, 2) . '%',
 ];
});



    return view('users.dashboard.index', compact('totalTests', 'averageScore', 'highestScore', 'testsPassed', 'testHistory', 'leaderboard'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
