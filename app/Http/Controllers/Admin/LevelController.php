<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LevelService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class LevelController extends Controller
{
    private $view = 'admin.level.';
    /**
     * @var LevelService
     */
    private $levelService;
    private $categoryService; // Add this line
    /**
     * @var DataTables
     */
    private $dataTables;

    /**
     * Display a listing of the resource.
     */
    public function __construct(
        LevelService $levelService,
        CategoryService $categoryService, // Add this line
        DataTables $dataTables
    ) {
        $this->levelService = $levelService;
        $this->dataTables = $dataTables;
        $this->categoryService = $categoryService; // Add this line
    }

    public function index(Request $request)
    {
        /*
        if ($request->wantsJson()) {
            return $this->datatable($request);
        }
        return view($this->view . 'index');
        */
        if ($request->wantsJson()) {
            $response = $this->datatable($request);
            Log::info('Datatable response', ['response' => $response]);
            return $response;
        }
        return view($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->all()->pluck('name', 'id'); // Adjust based on your Category model
        return view($this->view . 'create', compact('categories'));
        // return view($this->view . 'create');
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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $level = $this->levelService->find($id);
        // return view($this->view . 'edit', compact('level'));
        $level = $this->levelService->find($id);
        $categories = $this->categoryService->all()->pluck('name', 'id'); // Adjust based on your Category model

        return view($this->view . 'edit', compact('level', 'categories'));

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    private function datatable(Request $request)
    {
        $levels = $this->levelService->allWithCategory();
        Log::info('Retrieving all levels', ['levels' => $levels]);

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
