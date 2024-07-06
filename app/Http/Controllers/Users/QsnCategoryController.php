<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\QsnCategory;
use Illuminate\Http\Request;
use App\Models\Questions;
use Illuminate\Support\Facades\Log;

class QsnCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getQsnCategoyBySubject($subjectId)
    {

        // Log the incoming request
        Log::info("Fetching QsnCategories for subject_id: $subjectId");

        // Fetch distinct QsnCategories based on subject_id
        $questions = Questions::where('subject_id', $subjectId)
            ->with('qsnCategory') // Load the qsnCategory relationship
            ->get();

        // Extract unique qsnCategories by their IDs
        $qsnCategoriesData = $questions->unique('qsnCategory.id')->pluck('qsnCategory');

        // Map over the qsnCategories to format the data as needed
        $formattedCategories = $qsnCategoriesData->map(function ($qsnCategory) {
            // Determine type based on isObjective flag
            $type = $qsnCategory->isObjective ? 'Objective' : 'Subjective';

            // Return formatted data
            return [
                'id' => $qsnCategory->id,
                'name' => $qsnCategory->name,
                'weightage' => $qsnCategory->weightage,
                'type' => $type,
                // Add more fields as needed
            ];
        });

        // Log the extracted QsnCategory data
        Log::info("Extracted QsnCategory data: " . $formattedCategories);

        // Return the response
        return response()->json($formattedCategories);
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
    public function show(QsnCategory $qsnCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QsnCategory $qsnCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QsnCategory $qsnCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QsnCategory $qsnCategory)
    {
        //
    }
}
