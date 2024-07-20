<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Models\SubjectQuestionCategory;
use App\Services\CategoryService;
use App\Services\Question\ModelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ModelController extends Controller
{
    private $view = 'admin.question.models.';
    /**
     * @var DataTables
     */
    private $dataTables;
    /**
     * @var ModelService
     */
    private $modelService;
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * Display a listing of the resource.
     * @param DataTables $dataTables
     * @param ModelService $modelService
     * @param CategoryService $categoryService
     */
    public function __construct(
        DataTables $dataTables,
        ModelService $modelService,
        CategoryService $categoryService
    )
    {
        $this->dataTables = $dataTables;
        $this->modelService = $modelService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->datatable($request);
        }
        return view($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->all()->pluck('name', 'id');

        return view($this->view . 'create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->modelService->create($request->all());

        return redirect()->route('admin.question.model.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = $this->modelService->findOrFail($id)->load(['category', 'level', 'faculty', 'subFaculty']);

        return view($this->view . 'show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = $this->modelService->find($id);
        $categories = $this->categoryService->all()->pluck('name', 'id');

        return view($this->view . 'edit', compact('model', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->modelService->update($id, $request->all());

        return redirect()->route('admin.question.model.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->modelService->destroy($id);

        return redirect()->back();
    }

    public function modelsBySubFaculty($subFacultyId)
    {
        $models = $this->modelService->query()->where(['sub_faculty_id' => $subFacultyId])->get();

        return $models;
    }

    public function getSubjectCategoriesByModel($modelId)
    {
        $this->checkModel($modelId);
        $subjectQuestionCategories = SubjectQuestionCategory::where(['qsn_model_id' => $modelId])->with(['subject', 'qsnCategory']);

        return $this->dataTables->of($subjectQuestionCategories)
            ->addIndexColumn()
            ->make(true);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    private function datatable(Request $request)
    {
        $models = $this->modelService->query()->with(['category', 'level', 'faculty', 'subFaculty'])->get();
        Log::info('Retrieving all question models', ['models' => $models]);
        return $this->dataTables->of($models)
            ->addColumn('action', function ($model) {
                $params = [
                    'route' => 'admin.question.model',
                    'id' => $model->id,
                    'edit' => true,
                    'delete' => true,
                    'show' => true
                ];

                return view('admin.layouts.datatable.action', compact('params'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function checkModel($modelId)
    {
        $model = $this->modelService->find($modelId)->load(['questionCategories.qsnCategory']);
        $subjectQuestionCategories = $model->questionCategories;
        $min = 0;
        $max = 0;
        $this->distribution($model->full_mark, $subjectQuestionCategories);
        foreach ($subjectQuestionCategories as $qsnCategory) {
            $min += $qsnCategory->min * $qsnCategory->qsnCategory->weightage;
            $max += $qsnCategory->max * $qsnCategory->qsnCategory->weightage;
        }
        if ($model->full_marks >= $min && $model->full_marks <= $max) {
            return true;
        }
        return false;
    }

    public function distribution($fullMarks, $subjectQuestionCategories)
    {
        $allocated[] = [];
        $remaining[] = [];
        $weightage = 0;
        foreach ($subjectQuestionCategories as $qsnCategory) {
            $allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] = rand($qsnCategory->min, $qsnCategory->max);
            $remaining[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] = $qsnCategory->max - $allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name];
            $weightage += $qsnCategory->qsnCategory->weightage * $allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name];
        }
        $remainingWeightage = $fullMarks - $weightage;
        while($remainingWeightage !=0) {
            foreach ($subjectQuestionCategories as $qsnCategory) {
                if($remainingWeightage > 0) {
                    if($remaining[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] > 0) {
                        $remaining[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] -= 1;
                        $allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] += 1;
                        $weightage += $qsnCategory->qsnCategory->weightage;
                    }
                }
                else{
                    if($allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] > $qsnCategory->min) {
                        $remaining[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] += 1;
                        $allocated[$qsnCategory->subject->name][$qsnCategory->qsnCategory->name] -= 1;
                        $weightage -= $qsnCategory->qsnCategory->weightage;
                    }
                }
                $remainingWeightage = $fullMarks - $weightage;
                if ($remainingWeightage == 0) {
                    break;
                }
            }
        }

        return $allocated;
    }
}
