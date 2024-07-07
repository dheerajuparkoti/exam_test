<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Faculty;

use App\Services\LevelService;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    private $levelService;

    public function __construct(LevelService $levelService)
    {
        $this->levelService = $levelService;
    }

    public function index()
    {
        $levels = Level::all(); // Example query to retrieve all levels
        return view('users.exam.index', compact('levels'));
    }

    public function getLevelsByCategory($categoryId)
    {
        $levels = Level::where('category_id', $categoryId)->get();
        return response()->json($levels);
    }



}
