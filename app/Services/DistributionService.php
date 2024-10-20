<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;

class DistributionService
{
    public function distribute($model)
    {
        $subjectQuestionCategories = $model->questionCategories;
        $allocated = [];
        $remaining = [];
        $weightage = 0;

        // Initial Allocation Logic
        foreach ($subjectQuestionCategories as $qsnCategory) {
            $subjectName = $qsnCategory->subject->name;
            $categoryName = $qsnCategory->qsnCategory->name;

            $count = rand($qsnCategory->min, $qsnCategory->max);
            $weight = $qsnCategory->qsnCategory->weightage;

            $allocated[$subjectName][$categoryName] = [
                'count' => $count,
                'weightage' => $weight,
            ];

            $remaining[$subjectName][$categoryName] = $qsnCategory->max - $count;
            $weightage += $weight * $count;
        }

        $remainingWeightage = $model->fullMark - $weightage;

        // Weightage Adjustment Logic
        while ($remainingWeightage != 0) {
            foreach ($subjectQuestionCategories as $qsnCategory) {
                $subjectName = $qsnCategory->subject->name;
                $categoryName = $qsnCategory->qsnCategory->name;

                if ($remainingWeightage > 0 && $remaining[$subjectName][$categoryName] > 0) {
                    $allocated[$subjectName][$categoryName]['count'] += 1;
                    $remaining[$subjectName][$categoryName] -= 1;
                    $weightage += $qsnCategory->qsnCategory->weightage;
                } elseif ($remainingWeightage < 0 && $allocated[$subjectName][$categoryName]['count'] > $qsnCategory->min) {
                    $allocated[$subjectName][$categoryName]['count'] -= 1;
                    $remaining[$subjectName][$categoryName] += 1;
                    $weightage -= $qsnCategory->qsnCategory->weightage;
                }

                $remainingWeightage = $model->fullMark - $weightage;

                if ($remainingWeightage == 0) {
                    break;
                }
            }
        }

        return [
            'model' => $model,
            'data' => $allocated,
        ];
    }
}