<?php

namespace App\Http\Controllers;

use App\Models\ExamMaterialDocument;
use App\Models\School;
use Illuminate\Http\Request;


class SchoolController extends Controller
{
    public function getMaterials($id)
    {

        $school = School::find($id);

        if (!$school) {
            if (session('roleId') == 4) {
                return redirect()->intended('/student/home');
            }
            return redirect()->route('sa-home');
        }

        $materials = ExamMaterialDocument::join('teachers', 'teachers.id', '=', 'exam_material_documents.teacher_id')
            ->join('subjects', 'subjects.id', '=', 'exam_material_documents.subject_id')
            ->join('classes', 'classes.id', '=', 'exam_material_documents.class_id')
            ->join('users', 'users.id', '=', 'teachers.user_id')
            ->join('exam_materials', 'exam_materials.id', '=', 'exam_material_documents.material_id')
            ->where('teachers.school_id', $school['id'])
            ->select('exam_material_documents.id as id', 'title', 'subject_name', 'class_name', 'firstname', 'lastname', 'material_type', 'thumbnail', 'exam_material_documents.created_at as posted_at', 'marking_scheme')
            ->orderBy('posted_at', 'desc')
            ->get()
            ->toArray();

        $schoolName = $school['school_name'];
        $totalDocs = count($materials);

        return view('pages.student.school-materials', compact('materials', 'schoolName'));
    }

    public function materialDetail($id)
    {
        $material = ExamMaterialDocument::find($id);

        if (!$material) {
            if (session('roleId') == 4) return redirect()->intended('/student/home');

            return redirect()->route('sa-home');
        }


        $material_detail = ExamMaterialDocument::where('id', $material['id'])->first();

        return view('pages.student.material-detail', compact('material_detail'));
    }

    public function schemeDetail($id)
    {
        $material = ExamMaterialDocument::find($id);

        if (!$material) {
            if (session('roleId') == 4) return redirect()->intended('/student/home');

            return redirect()->route('sa-home');
        }


        $scheme_detail = ExamMaterialDocument::where('id', $material['id'])->first();

        return view('pages.student.scheme-detail', compact('scheme_detail'));
    }
}
