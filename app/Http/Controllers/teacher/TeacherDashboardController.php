<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\ExaminationCategory;
use App\Models\ExamMaterialDocument;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    public function getUserId()
    {
        try {
            $user = User::where('id', session('id'))->first()->id;
        } catch (Exception $e) {
            return view('pages.auth.login');
        }

        return $user;
    }

    public function index()
    {

        $userId = $this->getUserId();

        $materials = ExamMaterialDocument::join('teachers', 'teachers.id', '=', 'exam_material_documents.teacher_id')->where('teachers.user_id', $userId)->count();

        $dashboards = [
            // ['route' => 'teachers', 'class' => 'bg-warning', 'title' => 'Teachers', 'total' => $teachers],
            // ['route' => 'students', 'class' => 'bg-primary', 'title' => 'Students', 'total' => $students],
            // ['route' => 'school-admin', 'class' => 'bg-danger', 'title' => 'School admins', 'total' => $schoolAdmins],
            ['route' => 'teacher-materials', 'class' => 'bg-dark', 'title' => 'Materials', 'total' => $materials],
        ];

        return view('pages.admin.home', compact('dashboards'));
    }

    public function materials()
    {
        $userId = $this->getUserId();

        $teacherId = Teacher::where('user_id', $userId)->first()->id;

        $classes = TeacherSubject::select('class_id', 'class_name')->join('classes', 'classes.id', '=', 'teacher_subjects.class_id')->where('teacher_id', $teacherId)->get()->groupBy('class_id');

        $subjects = TeacherSubject::select('subject_id', 'subject_name')->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')->where('teacher_id', $teacherId)->get()->groupBy('subject_id');

        $materials = ExamMaterialDocument::with('teachers')
            ->with('exam_categories')->with('subjects')
            ->with('exam_materials')->with('classes')
            ->where('teachers.user_id', $userId)
            ->join('teachers', 'teachers.id', '=', 'exam_material_documents.teacher_id')
            ->orderBy('exam_material_documents.created_at')->get()->toArray();

        // $materials = ExamMaterialDocument::join('teachers', 'teachers.id', '=', 'exam_material_documents.teacher_id')->where('teachers.user_id', '=', $userId)->get();


        $exams = ExaminationCategory::where('id', '!=', 1)->where('id', '!=', 2)->get();
        // dd($materials);

        return view('pages.teacher.materials', compact('materials', 'classes', 'subjects', 'exams'));
    }

    public function uploadMaterial(Request $request)
    {

        $teacherId = Teacher::where('user_id', $this->getUserId())->first()->id;

        if ($request->input('material_id') == 4) {

            $request->validate([
                'material_id' => ['sometimes'],
                'exam_id' => ['required', 'numeric'],
                'title' => ['required', 'string', 'max:255'],
                'thumbnail' => ['required', 'image', 'max:2048', 'mimes:jpeg,jpg,png,JPEG, PNG, GIF'],
                'document' => ['required', 'file', 'max:61440', 'mimetypes:video/mp4,video/quicktime,video/x-ms-wmv,video/mpeg,video/x-mpeg,video/x-mpeg2a,video/webm'],
                'subject' => ['required', 'numeric'],
                'class' => ['required', 'numeric'],
                'year' => ['required', 'date_format:Y', 'before_or_equal:' . date('Y')],
                'year.date_format' => 'The year must be in the format of four digits',
            ]);
        } else {

            $request->validate([
                'material_id' => ['sometimes'],
                'exam_id' => ['required', 'numeric'],
                'title' => ['required', 'string', 'max:255'],
                'thumbnail' => ['required', 'image', 'max:2048', 'mimes:jpeg,jpg,png,JPEG, PNG, GIF'],
                'document' => ['required', 'file', 'max:12288', 'mimes:pdf,PDF'],
                'subject' => ['required', 'numeric'],
                'class' => ['required', 'numeric'],
                'year' => ['required', 'date_format:Y', 'before_or_equal:' . date('Y')],
                'year.date_format' => 'The year must be in the format of four digits',
            ]);
        }

        try {
            $material = new ExamMaterialDocument;
            $material->title = $request->input('title');
            $material->subject_id = $request->input('subject');
            $material->class_id = $request->input('class');
            $material->year = $request->input('year');
            $material->teacher_id = $teacherId;
            $material->material_id = $request->input('material_id');
            $material->exam_id = $request->input('exam_id');

            // Upload and save the thumbnail
            if ($request->hasFile('thumbnail')) {
                $thumbnailExtension = $request->file('thumbnail')->getClientOriginalExtension();
                $thumbnailName = time() . '_' . $request->file('thumbnail')->getClientOriginalName();
                $thumbnailPath = $request->file('thumbnail')->move(public_path('thumbnails'), $thumbnailName);
                $material->thumbnail = 'thumbnails/' . $thumbnailName;
            }

            if ($request->hasFile('document')) {
                $documentExtension = $request->file('document')->getClientOriginalExtension();
                $documentName = time() . '_' . $request->file('document')->getClientOriginalName();
                $documentPath = $request->file('document')->move(public_path('exam_materials'), $documentName);
                $material->document = 'exam_materials/' . $documentName;
            }

            $material->save();

            if (!$material) {
                return redirect()->back()->withInput()->with('error', 'Failed to upload exam material');
            }

            return redirect()->back()->with('success', 'Exam material uploaded successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
}
