<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

use App\Models\ExamPage;
use Illuminate\Http\Request;

class ExamPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.exam.index');
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
