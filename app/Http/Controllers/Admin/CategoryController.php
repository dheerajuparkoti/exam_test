<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    private $view = 'admin.category.';
    /**
     * @var CategoryService
     */
    private $categoryService;
    /**
     * @var DataTables
     */
    private $dataTables;

    /**
     * Display a listing of the resource.
     */
    public function __construct(
        CategoryService $categoryService,
        DataTables $dataTables
    )
    {
        $this->categoryService = $categoryService;
        $this->dataTables = $dataTables;
    }

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
        return view($this->view.'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->categoryService->create($request->all());

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryService->find($id);

        return view($this->view.'edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->categoryService->update($id, $request->all());

        return redirect()->route('admin.category.index');
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
        $categories = $this->categoryService->all();

        return $this->dataTables->of($categories)
            ->addColumn('action', function ($category) {
                $params = [
                    'route' => 'admin.category',
                    'id' => $category->id,
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
