<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Models\ExamPage;
use App\Services\ExamService;
use App\Services\DistributionService;
use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\QsnModel;
use Illuminate\Support\Facades\Log;
use App\Models\Category; // Ensure you have this model
use App\Models\Level;    // Ensure you have this model
use App\Models\Faculty;  // Ensure you have this model
use App\Models\History;

class ExamPageController extends Controller
{
    // Declare the properties for the services
    private $examService;
    private $distributionService;

    // Combined constructor to inject both services
    public function __construct(ExamService $examService, DistributionService $distributionService)
    {
        // Assign the injected services to the properties
        $this->examService = $examService;
        $this->distributionService = $distributionService;
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

    public function loadRoom(Request $request)
    {
         // Retrieve the values from the URL parameters
    // $category_id = $request->query('category');
    // $level_id = $request->query('level');
    // $faculty_id = $request->query('faculty');
    // $subFaculty_id = $request->query('sub-faculty');
    // $qsn_model_id = $request->query('model');

     // Retrieve the values from the POST request body
     $data = $request->all();

     $passMark = $data['pass_mark'];
     $fullMark = $data['full_mark'];
     $timeLimit = $data['time_limit'];
     $category_id = $request->input('category');
     $level_id = $request->input('level');
     $faculty_id = $request->input('faculty');
     $subFaculty_id = $request->input('sub-faculty');
     $qsn_model_id = $request->input('model');




    // Query the names from the respective tables using the provided IDs
    $category = Category::find($category_id); // Assuming the model name is 'Category'
    $level = Level::find($level_id);          // Assuming the model name is 'Level'
    $faculty = Faculty::find($faculty_id);    // Assuming the model name is 'Faculty'
    $subFaculty = Faculty::find($subFaculty_id); // Assuming sub-faculty is stored in the same 'Faculty' table


 // Fetch qsn_model details
    $qsnModel = QsnModel::find($qsn_model_id);
    $publishedDate = $qsnModel ? $qsnModel->created_at : null;

    // Count the number of participants
    $participantCount = History::where('qsn_model_id', $qsn_model_id)
        ->distinct('user_id')
        ->count('user_id');

    // Fetch all obtained marks
    $obtainedMarks = History::where('qsn_model_id', $qsn_model_id)
        ->pluck('obtained_marks');

    // Calculate the pass percentage
    $passCount = $obtainedMarks->filter(function ($mark) use ($passMark) {
        return $mark >= $passMark;
    })->count();

    $passPercentage = $participantCount > 0 ? ($passCount / $participantCount) * 100 : 0;


    // Pass the retrieved names to the view
    return view('users.exam.room', [
        'category' => $category ? $category->name : null,
        'level' => $level ? $level->name : null,
        'faculty' => $faculty ? $faculty->name : null,
        'subFaculty' => $subFaculty ? $subFaculty->name : null,
        'qsn_model_id' => $qsn_model_id, // Assuming you want to pass the model_id directly
        'fullMark' => $fullMark,
        'passMark' => $passMark,
        'timeLimit' => $timeLimit,
        'publishedDate' => $publishedDate,
        'participantCount' => $participantCount,
        'passPercentage' => $passPercentage
    ]);    }


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
    try {
        // Validate the request data
        $validated = $request->validate([
            'totalQuestion' => 'required|numeric',            
            'totalSkippedQsn' => 'nullable|numeric',
            'totalAnsweredQsn' => 'nullable|numeric',
            'totalObtainedMarks' => 'required|numeric',
            'totalCorrectCount' => 'required|numeric',
            'user_id'=> 'required|integer',
            'qsn_model_id'=> 'required|integer'
        ]);

        // Process the data (Business logic)
        // Log or debug the validated data to ensure correctness
        Log::info('Validated Data:', $validated);

           // Store the validated data in the histories table
           History::create([
            'total_qsn' => $validated['totalQuestion'],
            'skipped_qsn' => $validated['totalSkippedQsn'],
            'answered_qsn' => $validated['totalAnsweredQsn'],
            'obtained_marks' => $validated['totalObtainedMarks'],
            'correct_count' => $validated['totalCorrectCount'],
            'user_id' => $validated['user_id'],
            'qsn_model_id' => $validated['qsn_model_id']
        ]);

        return response()->json([
            'status' => 'success',
            'totalQuestion'=>$validated['totalQuestion'],
            'totalAnsweredQsn'=>$validated['totalAnsweredQsn'],
            'totalSkippedQsn'=>$validated['totalSkippedQsn'],
            'totalCorrectCount' => $validated['totalCorrectCount'],
            'totalObtainedMarks' => $validated['totalObtainedMarks']
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Capture and log validation errors
        Log::error('Validation failed:', ['errors' => $e->errors()]);
        return response()->json(['status' => 'error', 'message' => 'Validation error occurred.'], 422);
    } catch (\Exception $e) {
        // Log the exception message
        Log::error('Error in store method:', ['message' => $e->getMessage()]);
        return response()->json(['status' => 'error', 'message' => 'An error occurred.'], 500);
    }
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
    public function getRandomQuestions()
    {
        // Fetch 50 random questions along with their weightage from qsn_categories_table
        $questions = Questions::select('questions.id', 'questions.title', 'questions.description', 'questions.options', 'qsn_categories.weightage')
            ->join('qsn_categories', 'questions.qsn_category_id', '=', 'qsn_categories.id') // Join to get weightage
            ->inRandomOrder()
            ->limit(100)
            ->get();
    
        // Count total questions
        $totalQuestions = $questions->count();
    
        // Iterate through each question to parse the options and set correct option
        foreach ($questions as $question) {
            // Decode options if they are stored as JSON
            $optionsArray = is_array($question->options) ? $question->options : json_decode($question->options, true);
    
            // Initialize variables for options and the correct option
            $options = [];
            $correctOption = null;
    
            // Process each option
            foreach ($optionsArray as $option) {
                // Ensure 'option' key exists
                $optionText = isset($option['option']) ? $option['option'] : '';
                $options[] = $optionText; // Add option to the options list
    
                // Ensure 'is_correct' key exists and check its value
                if (isset($option['is_correct']) && $option['is_correct']) {
                    $correctOption = $optionText;
                }
            }
    
            // Assign processed options and correct option back to the question
            $question->options = $options;
            $question->correct_option = $correctOption;
        }
    
        // Log questions for debugging
        Log::info($questions->toArray());
    
        // Return the questions with weightage as JSON response
        return response()->json([
            'status' => 'success',
            'data' => $questions,
            'totalQuestions' => $totalQuestions, // Include total question count
        ]);
    }
}    