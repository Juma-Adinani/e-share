<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    use WithoutModelEvents;
    public function run()
    {
        DB::table('exam_materials')->insert([
            ['material_type' =>'Exam', 'created_at' => now(), 'updated_at' => now()],
            ['material_type' =>'Notes', 'created_at' => now(), 'updated_at' => now()],
            ['material_type' =>'Quiz', 'created_at' => now(), 'updated_at' => now()],
            ['material_type' =>'Learn & Practices', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
