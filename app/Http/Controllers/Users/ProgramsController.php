<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Subjects;
use Illuminate\Http\Request;
use App\Models\Programs;

class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getProgramsByFaculty($facultyId)
    {
        $programs = Programs::where('faculty_id', $facultyId)->get();
        return response()->json($programs);
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


    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */

}
