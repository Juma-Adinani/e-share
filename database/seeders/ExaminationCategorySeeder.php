<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExaminationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    use WithoutModelEvents;
    public function run()
    {
        DB::table('examination_categories')->insert([
            [
                'exam_type' => 'other',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'exam_type' => 'NECTA EXAM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'exam_type' => 'ANNUAL EXAM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'exam_type' => 'TERMINAL EXAM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'exam_type' => 'MID-TERM EXAM',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
