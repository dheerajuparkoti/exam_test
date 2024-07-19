<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\Question\CategoryService as QsnCategoryService;
use App\Services\Question\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class QuestionController extends Controller
{
    private $view = 'admin.question.question.';
    /**
     * @var DataTables
     */
    private $dataTables;
    /**
     * @var QuestionService
     */
    private $questionService;
    /**
     * @var CategoryService
     */
    private $categoryService;
    /**
     * @var QsnCategoryService
     */
    private $qsnCategoryService;

    /**
     * Display a listing of the resource.
     * @param DataTables $dataTables
     * @param QuestionService $questionService
     * @param CategoryService $categoryService
     * @param QsnCategoryService $qsnCategoryService
     */
    public function __construct(
        DataTables $dataTables,
        QuestionService $questionService,
        CategoryService $categoryService,
        QsnCategoryService $qsnCategoryService
    ) {
        $this->dataTables = $dataTables;
        $this->questionService = $questionService;
        $this->categoryService = $categoryService;
        $this->qsnCategoryService = $qsnCategoryService;
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
        $qsnCategories = $this->qsnCategoryService->all()->pluck('name', 'id');

        return view($this->view . 'create', compact('categories', 'qsnCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->questionService->create($request->all());

        return redirect()->route('admin.question.index');
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
        $question = $this->questionService->find($id);

        return view($this->view . 'edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->questionService->update($id, $request->all());

        return redirect()->route('admin.question.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->questionService->destroy($id);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    private function datatable(Request $request)
    {
        $questions = $this->questionService->query()->with(['qsnCategory', 'subject'])->get();
        Log::info('Retrieving all questions', ['questions' => $questions]);
        return $this->dataTables->of($questions)
            ->editColumn('options', function ($question) {
                $options = '<ul>';
                foreach ($question->options as $option) {
                    $class = (isset($option['is_correct']) && $option['is_correct'] == 1) ? "bg-success" : "";
                    $options .= '<li class=' . $class . '>' . $option['option'] . '</li>';
                }
                $options .= '<ul>';
                return $options;
            })
            ->addColumn('action', function ($question) {
                $params = [
                    'route' => 'admin.question',
                    'id' => $question->id,
                    'edit' => true,
                    'delete' => true,
                ];

                return view('admin.layouts.datatable.action', compact('params'));
            })
            ->rawColumns(['action', 'options'])
            ->addIndexColumn()
            ->make(true);
    }
}
