<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Services\Question\CategoryService;
use App\Services\Question\ModelService;
use App\Services\SubjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class SubjectCategoryController extends Controller
{
    private $view = 'admin.question.subject-category.';
    private $subject;
    /**
     * @var DataTables
     */
    private $dataTables;
    /**
     * @var SubjectService
     */
    private $subjectService;
    /**
     * @var CategoryService
     */
    private $categoryService;
    /**
     * @var ModelService
     */
    private $modelService;

    /**
     * Display a listing of the resource.
     * @param DataTables $dataTables
     * @param SubjectService $subjectService
     * @param CategoryService $categoryService
     * @param ModelService $modelService
     */
    public function __construct(
        DataTables $dataTables,
        SubjectService $subjectService,
        CategoryService $categoryService,
        ModelService $modelService
    )
    {
        $this->dataTables = $dataTables;
        $subjectId = request()->route('subject');
        $this->subject = $subjectService->find($subjectId);
        $this->subjectService = $subjectService;
        $this->categoryService = $categoryService;
        $this->modelService = $modelService;
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
        $subject = $this->subject;
        $questionCategories = $this->categoryService->all()->pluck('name', 'id');
        $questionModels = $this->modelService->getWhere(['sub_faculty_id' => $subject->sub_faculty_id])->pluck('name', 'id');
        return view($this->view . 'create', compact('questionCategories', 'questionModels', 'subject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $questionCategoryId = $request->input('qsn_category_id');
        $this->subject->questionCategories()->attach($questionCategoryId, $request->only(['min', 'max', 'qsn_model_id']));

        return redirect()->route('admin.subject.show', $this->subject->id);
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
    public function edit(string $subjectId, $categoryId)
    {
        $subject = $this->subject;
        $questionCategories = $this->categoryService->all()->pluck('name', 'id');
        $questionModels = $this->modelService->getWhere(['sub_faculty_id' => $subject->sub_faculty_id])->pluck('name', 'id');
        $category = $subject->questionCategories()->wherePivot('id', $categoryId)->first();

        return view($this->view . 'edit', compact('questionCategories', 'questionModels', 'subject','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $subjectId, $categoryId)
    {
        $questionCategoryId = $request->input('qsn_category_id');
        $this->subject->questionCategories()->updateExistingPivot($questionCategoryId, $request->only(['min', 'max', 'qsn_model_id']));

        return redirect()->route('admin.subject.show', $this->subject->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoryService->destroy($id);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    private function datatable(Request $request)
    {
        $subject = $this->subject;
        $categories = $subject->questionCategories()->get();
        Log::info('Retrieving all question categories', ['categories' => $categories]);
        return $this->dataTables->of($categories)
            ->addColumn('qsnModel', function($category) {
                return $category->pivot->model->name;
            })
            ->addColumn('action', function ($category) use($subject) {
                return view('admin.question.subject-category.action', compact('subject','category'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
