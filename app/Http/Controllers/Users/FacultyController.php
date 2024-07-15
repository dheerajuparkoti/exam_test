<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import the Log facade

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function getFacultiesByCategory(Request $request, $category)
    {
        $faculties = Faculty::where('category_id', $category)->get();
        return response()->json($faculties);
    }


    public function getSubFacultiesByFaculty(Request $request, $facultyId)
    {
        $sub_faculties = Faculty::where('parent_id', $facultyId)->get();
        return response()->json($sub_faculties);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        //
    }
}
