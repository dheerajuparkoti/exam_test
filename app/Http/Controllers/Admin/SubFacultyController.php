<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\FacultyService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubFacultyController extends Controller
{
    private $view = 'admin.subfaculty.';
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
     * SubFacultyController constructor.
     * @param DataTables $dataTables
     * @param FacultyService $facultyService
     * @param CategoryService $categoryService
     */
    public function __construct(
        DataTables $dataTables,
        FacultyService $facultyService,
        CategoryService $categoryService
    )
    {
        $this->dataTables = $dataTables;
        $this->facultyService = $facultyService;
        $this->categoryService = $categoryService;
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

        return redirect()->route('admin.sub-faculty.index');
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
        $subFaculty = $this->facultyService->find($id);
        $categories = $this->categoryService->all()->pluck('name', 'id');

        return view($this->view.'edit', compact('categories', 'subFaculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->facultyService->update($id, $request->all());

        return redirect()->route('admin.sub-faculty.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->facultyService->destroy($id);

        return redirect()->back();
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    private function datatable(Request $request)
    {
        $subFaculties = $this->facultyService->query()->whereNotNull(['parent_id'])->with(['faculty', 'category', 'level'])->get();

        return $this->dataTables->of($subFaculties)
            ->addColumn('action', function ($subFaculty) {
                $params = [
                    'route' => 'admin.sub-faculty',
                    'id' => $subFaculty->id,
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
