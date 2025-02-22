<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\LevelService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LevelController extends Controller
{
    private $view = 'admin.level.';
    /**
     * @var DataTables
     */
    private $dataTables;
    /**
     * @var LevelService
     */
    private $levelService;
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * LevelController constructor.
     * @param DataTables $dataTables
     * @param LevelService $levelService
     * @param CategoryService $categoryService
     */
    public function __construct(
        DataTables $dataTables,
        LevelService $levelService,
        CategoryService $categoryService
    )
    {
        $this->dataTables = $dataTables;
        $this->levelService = $levelService;
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
        $this->levelService->create($request->all());

        return redirect()->route('admin.level.index');
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
        $level = $this->levelService->find($id);
        $categories = $this->categoryService->all()->pluck('name', 'id');

        return view($this->view.'edit', compact('level', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->levelService->update($id, $request->all());

        return redirect()->route('admin.level.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->levelService->destroy($id);

        return redirect()->back();
    }

    public function levelsByCategory($categoryId) {
        $levels = $this->levelService->getWhere(['category_id' => $categoryId]);

        return $levels;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    private function datatable(Request $request)
    {
        $levels = $this->levelService->query()->with(['category'])->get();

        return $this->dataTables->of($levels)
            ->addColumn('action', function ($level) {
                $params = [
                    'route' => 'admin.level',
                    'id' => $level->id,
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
