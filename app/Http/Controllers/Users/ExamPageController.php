<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Models\ExamPage;
use App\Services\ExamService;
use Illuminate\Http\Request;
use App\Models\Questions;
use Illuminate\Support\Facades\Log;

class ExamPageController extends Controller
{
    private $examService;
    private $categoryService;
    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->examService->all();
        $levels = []; // Initially empty, to be populated dynamically based on category selection.
        return view('users.exam.index', compact('categories', 'levels'));
    }

    public function loadRoom()
    {
        return view('users.exam.room');
    }


    public function form()
    {

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
    public function show(ExamPage $examPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamPage $examPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamPage $examPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamPage $examPage)
    {
        //
    }

    public function getRandomQuestions($qsn_model_id)
    {
        try {
            // Query to fetch random questions
            $questions = Questions::inRandomOrder()
                ->where('qsn_model_id', $qsn_model_id)
                ->limit(4)
                ->get();

            // Log success
            Log::info('Successfully fetched questions for qsn_model_id: ' . $qsn_model_id);

            return response()->json($questions);
        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to fetch questions: ' . $e->getMessage());

            // Return error response
            return response()->json(['error' => 'Failed to fetch questions.'], 500);
        }
    }
}
