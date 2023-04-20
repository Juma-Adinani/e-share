<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    use WithoutModelEvents;
    public function run()
    {
        $subjects = [
            ['subject_name' => 'KISWAHILI'],
            ['subject_name' => 'BASIC MATHEMATICS'],
            ['subject_name' => 'ADVANCED MATHEMATICS'],
            ['subject_name' => 'GEOGRAPHY'],
            ['subject_name' => 'BIOLOGY'],
            ['subject_name' => 'BASIC APPLIED MATHEMATICS'],
            ['subject_name' => 'HISTORY'],
            ['subject_name' => 'CHEMISTRY'],
            ['subject_name' => 'CIVICS'],
            ['subject_name' => 'PHYSICS'],
            ['subject_name' => 'ENGLISH LANGUAGE']
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
