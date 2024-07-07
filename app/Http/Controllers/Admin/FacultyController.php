<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\FacultyService;
use App\Services\LevelService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FacultyController extends Controller
{
    private $view = 'admin.faculty.';
    /**
     * @var DataTables
     */
    private $dataTables;
    /**
     * @var FacultyService
     */
    private $facultyService;
    /**
     * @var CategoryService
     */
    private $categoryService;
    /**
     * @var LevelService
     */
    private $levelService;

    /**
     * FacultyController constructor.
     * @param DataTables $dataTables
     * @param FacultyService $facultyService
     */
    public function __construct(
        DataTables $dataTables,
        FacultyService $facultyService,
        CategoryService $categoryService,
        LevelService $levelService
    )
    {
        $this->dataTables = $dataTables;
        $this->facultyService = $facultyService;
        $this->categoryService = $categoryService;
        $this->levelService = $levelService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->wantsJson()) {
            return $this->datatable($request);
        }
        return view($this->view.'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->all()->pluck('name', 'id');

        return view($this->view.'create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->facultyService->create($request->all());

        return redirect()->route('admin.faculty.index');
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
        $faculty = $this->facultyService->find($id);
        $categories = $this->categoryService->all()->pluck('name', 'id');

        return view($this->view.'edit', compact('faculty', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->facultyService->update($id, $request->all());

        return redirect()->route('admin.faculty.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->facultyService->destroy($id);

        return redirect()->back();
    }
    public function facultiesByLevel($levelId) {
        $faculties = $this->facultyService->query()->where(['level_id' => $levelId])->whereNull('parent_id')->get();

        return $faculties;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    private function datatable(Request $request)
    {
        $faculties = $this->facultyService->query()->whereNull(['parent_id'])->with(['category', 'level'])->get();

        return $this->dataTables->of($faculties)
            ->addColumn('action', function ($faculty) {
                $params = [
                    'route' => 'admin.faculty',
                    'id' => $faculty->id,
                    'edit' => true,
                    'delete' => true,
                ];

                return view('admin.layouts.datatable.action', compact('params'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
