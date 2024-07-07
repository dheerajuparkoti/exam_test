<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Models\ExamPage;
use App\Services\ExamService;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Level;

class ExamPageController extends Controller
{
    private $examService;
    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.exam.form');
    }


    public function form()
    {

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
    public function show(ExamPage $examPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamPage $examPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamPage $examPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamPage $examPage)
    {
        //
    }
}
