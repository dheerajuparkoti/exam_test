<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\QsnModel;
use App\Services\Question\ModelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\SubjectQuestionCategory;
use App\Models\Questions;
use App\Models\Subject;
use App\Models\QsnCategory;


class QsnModelController extends Controller
{
    /**
     * @var ModelService
     */
    private $modelService;

    /**
     * QsnModelController constructor.
     * @param ModelService $modelService
     */
    public function __construct(
        ModelService $modelService
    ) {
        $this->modelService = $modelService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getModels(Request $request)
    {
        $models = $this->modelService->getWhere(['sub_faculty_id' => $request->query('sub_faculty_id')]);
        $result = [];
        foreach ($models as $model) {
            if ($this->checkModel($model->id)) {
                $result['models'] = $models;
            }
        }
        return response()->json($result);
    }
    public function getModels1(Request $request)
    {
        $categoryId = $request->query('category_id');
        $levelId = $request->query('level_id');
        $facultyId = $request->query('faculty_id');
        $subFacultyId = $request->query('sub_faculty_id');

        Log::info('Received request with parameters:', [
            'category_id' => $categoryId,
            'level_id' => $levelId,
            'faculty_id' => $facultyId,
            'sub_faculty_id' => $subFacultyId,
        ]);

        // Retrieve models based on the query parameters
        $models = QsnModel::where('sub_faculty_id', $subFacultyId)
            ->distinct()->with(['questionCategories'])
            ->get();

        Log::info('Retrieved models:', ['models' => $models]);

        $result = [];
        $totalWeightage = 0;

        foreach ($models as $model) {
            $modelId = $model->id;
            foreach ($model->questionCategories as $subjectCategory) {
                $subjectId = $subjectCategory->subject_id;
                $qsnCategoryId = $subjectCategory->qsn_category_id;
                $min = $subjectCategory->min;
                $max = $subjectCategory->max;

                // Choose a random number between min and max
                $randomNumber = rand($min, $max);

                // Count questions in the questions table
                $questionCount = DB::table('questions')
                    ->where('subject_id', $subjectId)
                    ->where('qsn_category_id', $qsnCategoryId)
                    ->count();

                Log::debug('Checking subject and category:', [
                    'subject_id' => $subjectId,
                    'qsn_category_id' => $qsnCategoryId,
                    'random_number' => $randomNumber,
                    'question_count' => $questionCount,
                ]);

                // Check if the random number is less than or equal to the question count
                if ($randomNumber <= $questionCount) {
                    // Retrieve the weightage from the qsn_category table
                    $qsnCategory = DB::table('qsn_categories')
                        ->where('id', $qsnCategoryId)
                        ->first();

                    // Retrieve the subject name
                    $subject = DB::table('subjects')
                        ->where('id', $subjectId)
                        ->first();

                    // Calculate weightage based on the condition
                    $weightage = $qsnCategory->weightage * $questionCount;

                    // Add the weightage to total weightage
                    $totalWeightage += $weightage;

                    Log::info('Matching model found and added to results:', [
                        'model' => $model,
                        'qsn_category' => $qsnCategory,
                        'subject' => $subject,
                        'weightage' => $weightage,
                    ]);
                }
            }

            $modelData = [
                'id' => $modelId,
                'name' => $model->name,
                'full_mark' => $model->full_mark,
                'pass_mark' => $model->pass_mark,
                'time_limit' => $model->time_limit,
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ];

            // Add the model data to the result

        }
        $result[] = $modelData;
        Log::info('Total weightage calculated:', ['total_weightage' => $totalWeightage]);


        if ($totalWeightage >= 50) {
            Log::info('Total weightage meets or exceeds 100, returning results.');

            // At the end, add subjects and question categories details
            foreach ($result as &$modelData) {
                $modelId = $modelData['id'];

                // Get subject and category details from subject_qsn_categories table
                $subjectCategories = DB::table('subject_qsn_categories')
                    ->where('qsn_model_id', $modelId)
                    ->get();

                $subjectsData = [];
                $questionCategoriesData = [];

                foreach ($subjectCategories as $subjectCategory) {
                    $subject = DB::table('subjects')
                        ->where('id', $subjectCategory->subject_id)
                        ->first();
                    $qsnCategory = DB::table('qsn_categories')
                        ->where('id', $subjectCategory->qsn_category_id)
                        ->first();

                    $subjectsData[] = [
                        'id' => $subject->id,
                        'name' => $subject->name,
                        // Add any other necessary fields from the Subject table
                    ];

                    $questionCategoriesData[] = [
                        'id' => $qsnCategory->id,
                        'name' => $qsnCategory->name,
                        'weightage' => $qsnCategory->weightage,
                        // Add any other necessary fields from the QsnCategory table
                    ];
                }

                // Add subjects and question categories details to the model data
                $modelData['subjects'] = $subjectsData;
                $modelData['question_categories'] = $questionCategoriesData;
            }

            // Return the final result with subjects and question categories details
            return response()->json($result);
        } else {
            Log::info('Total weightage does not meet 100, returning empty result.');
            return response()->json([]);
        }


    }

    public function checkModel($modelId)
    {
        $model = $this->modelService->find($modelId)->load(['questionCategories.qsnCategory']);
        $subjectQuestionCategories = $model->questionCategories;
        $min = 0;
        $max = 0;
        foreach ($subjectQuestionCategories as $qsnCategory) {
            $min += $qsnCategory->min * $qsnCategory->qsnCategory->weightage;
            $max += $qsnCategory->max * $qsnCategory->qsnCategory->weightage;
        }
        if ($model->full_marks >= $min && $model->full_marks <= $max) {
            return true;
        }
        return false;
    }
    public function distribution(Request $request)
    {
        $allocated = []; // Ensure this variable is initialized
        $model = $this->modelService->find($request->query('model_id'))->load(['questionCategories.qsnCategory']);
        $subjectQuestionCategories = $model->questionCategories;
        $weightage = 0;
        foreach ($subjectQuestionCategories as $qsnCategory) {
            $allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name]['count'] = rand($qsnCategory->min, $qsnCategory->max);
            $allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name]['weightage'] = $qsnCategory->qsnCategory->weightage;
            $remaining[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] = $qsnCategory->max - $allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name]['count'];
            $weightage += $qsnCategory->qsnCategory->weightage * $allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name]['count'];
        }
        $remainingWeightage = $model->fullMark - $weightage;
        while ($remainingWeightage != 0) {
            foreach ($subjectQuestionCategories as $qsnCategory) {
                if ($remainingWeightage > 0) {
                    if ($remaining[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] > 0) {
                        $remaining[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] -= 1;
                        $allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name]['count'] += 1;
                        $weightage += $qsnCategory->qsnCategory->weightage;
                    }
                } else {
                    if ($allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name]['count'] > $qsnCategory->min) {
                        $remaining[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] += 1;
                        $allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name]['count'] -= 1;
                        $weightage -= $qsnCategory->qsnCategory->weightage;
                    }
                }
                $remainingWeightage = $model->full_mark - $weightage;
                if ($remainingWeightage == 0) {
                    break;
                }
            }
        }

        // Log the data to the Laravel log file
        Log::info('Model Data:', ['model' => $model]);
        Log::info('Allocated Data:', ['data' => $allocated]);
        return response()->json(
            [
                'model' => $model,
                'data' => collect($allocated)
            ]
        );
    }

    public function index()
    {
        //
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
    public function show(QsnModel $qsnModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QsnModel $qsnModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QsnModel $qsnModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QsnModel $qsnModel)
    {
        //
    }
}
