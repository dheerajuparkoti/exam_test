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

    public function getQsnTypeBySubject($subjectId)
    {
        $distinctSubjectIds = Questions::where('subject_id', $subjectId)
            ->distinct('subject_id')
            ->pluck('subject_id');

        // Fetch distinct qsn_category_ids based on the fetched subject_ids
        $distinctQsnCategoryIds = Questions::whereIn('subject_id', $distinctSubjectIds)
            ->distinct('qsn_category_id')
            ->pluck('qsn_category_id');

        // Fetch all QsnCategory data for the distinct qsn_category_ids
        $qsnCategoriesData = QsnCategory::whereIn('id', $distinctQsnCategoryIds)->get();

        $responseData = [];

        // Iterate over the collection to build the response data
        foreach ($qsnCategoriesData as $qsnCategory) {
            $type = $qsnCategory->isObjective ? 'Objective' : 'Subjective';
            $responseData[] = [
                'id' => $qsnCategory->id,
                'name' => $qsnCategory->name,
                'type' => $type,
                'weightage' => $qsnCategory->weightage,
                // Add more fields as needed
            ];
        }

        // Log the fetched data (optional)
        Log::info("Fetched QsnCategory data for distinct qsn_category_ids: " . $qsnCategoriesData);

        // Return the response
        return response()->json($responseData);
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
