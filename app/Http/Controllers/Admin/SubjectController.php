<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\FacultyService;
use App\Services\LevelService;
use App\Services\SubjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class SubjectController extends Controller
{
    private $view = 'admin.subject.';
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
     * @var LevelService
     */
    private $levelService;
    /**
     * @var FacultyService
     */
    private $facultyService;

    /**
     * SubjectController constructor.
     * @param DataTables $dataTables
     * @param SubjectService $subjectService,
     */
    public function __construct(
        DataTables $dataTables,
        CategoryService $categoryService,
        LevelService $levelService,
        FacultyService $facultyService,
        SubjectService $subjectService
    )
    {
        $this->dataTables = $dataTables;
        $this->subjectService = $subjectService;
        $this->categoryService = $categoryService;
        $this->levelService = $levelService;
        $this->facultyService = $facultyService;
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
        $this->subjectService->create($request->all());

        return redirect()->route('admin.subject.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = $this->subjectService->find($id)->load('category', 'faculty', 'level');

        return view($this->view.'show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = $this->categoryService->all()->pluck('name', 'id');
        $subject = $this->subjectService->find($id);

        return view($this->view . 'edit', compact('subject', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->subjectService->update($id, $request->all());

        return redirect()->route('admin.subject.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->subjectService->destroy($id);

        return redirect()->back();
    }

    public function subjectsBySubFaculty($subFacultyId) {
        $subjects = $this->subjectService->query()->where(['sub_faculty_id' => $subFacultyId])->get();

        return $subjects;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    private function datatable(Request $request)
    {
        $subjects = $this->subjectService->query()->with(['category', 'level', 'faculty', 'subFaculty'])->get();
        Log::info('Retrieving all subjects', ['subjects' => $subjects]);
        return $this->dataTables->of($subjects)
            ->addColumn('action', function ($subject) {
                $params = [
                    'route' => 'admin.subject',
                    'id' => $subject->id,
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
}
