<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\ExamMaterialDocument;
use App\Models\School;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{

    public function index()
    {
        $schools = School::count();
        $materials = ExamMaterialDocument::count();

        $dashboards = [
            // ['route' => 'teachers', 'class' => 'bg-warning', 'title' => 'Teachers', 'total' => $teachers],
            // ['route' => 'students', 'class' => 'bg-primary', 'title' => 'Students', 'total' => $students],
            ['route' => 'school-list', 'class' => 'bg-success', 'title' => 'Schools', 'total' => $schools],
            ['route' => 'school-list', 'class' => 'bg-primary', 'title' => 'Materials', 'total' => $materials],
        ];

        return view('pages.admin.home', compact('dashboards'));
    }
    public function schools()
    {
        $schools = School::all();

        foreach ($schools as $school) {
            $totalDocs = ExamMaterialDocument::join('teachers', 'teachers.id', '=', 'exam_material_documents.teacher_id')
                ->join('schools', 'schools.id', '=', 'teachers.school_id')
                ->where('schools.id', $school->id)
                ->count();
            $school->totalDocs = $totalDocs;
        }

        return view('pages.student.home', compact('schools'));
    }
}
