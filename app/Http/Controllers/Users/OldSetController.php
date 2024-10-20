<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OldSet;

class OldSetController extends Controller
{
    public function index()
    {
        // Retrieve all old sets
        $oldSets = OldSet::all();
        return view('users.oldsets.index', compact('oldSets'));
    }

    public function search(Request $request)
    {
        // Retrieve old sets based on the search term
        $query = $request->input('search');
        $oldSets = OldSet::where('description', 'LIKE', '%' . $query . '%')->get();
        return view('users.oldsets.index', compact('oldSets'));
    }
}
