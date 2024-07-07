<?php

namespace Database\Seeders;

use App\Services\LevelService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * @var LevelService
     */
    private $levelService;

    /**
     * LevelSeeder constructor.
     * @param LevelService $levelService
     */
    public function __construct(
        LevelService $levelService
    )
    {
        $this->levelService = $levelService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $levels = [
            ['name' => 'Bachelor', 'category_id' => 1],
            ['name' => '7th level', 'category_id' => 2],
            ['name' => '5th level', 'category_id' => 2],
            ['name' => '4th level', 'category_id' => 2],
            ['name' => 'Diploma', 'category_id' => 3],
            ['name' => 'Bachelor', 'category_id' => 3],
        ];

        $this->levelService->truncate();
        foreach ($levels as $level) {
            $this->levelService->create($level);
        }
    }
}
