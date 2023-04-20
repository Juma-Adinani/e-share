<?php

namespace App\Http\Controllers\schooladmin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ExamMaterialDocument;
use App\Models\SchoolAdmin;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SchoolAdminController extends Controller
{
    public function getSchoolId()
    {
        try {
            $schoolId = SchoolAdmin::where('user_id', session('id'))->first()->school_id;
        } catch (Exception $e) {
            return view('pages.auth.login');
        }

        return $schoolId;
    }

    public function index()
    {

        $schoolId = $this->getSchoolId();

        $teachers = Teacher::where('school_id', $schoolId)->count();
        $students = Student::where('school_id', $schoolId)->count();

        $materials = ExamMaterialDocument::join('teachers', 'teachers.id', '=', 'exam_material_documents.teacher_id')->where('teachers.school_id', $schoolId)->count();

        $dashboards = [
            ['route' => 'teachers', 'class' => 'bg-warning', 'title' => 'Teachers', 'total' => $teachers],
            ['route' => 'students', 'class' => 'bg-primary', 'title' => 'Students', 'total' => $students],
            // ['route' => 'school-admin', 'class' => 'bg-danger', 'title' => 'School admins', 'total' => $schoolAdmins],
            ['route' => 'materials', 'class' => 'bg-dark', 'title' => 'Materials', 'total' => $materials],
        ];

        return view('pages.admin.home', compact('dashboards'));
    }

    public function teachers()
    {

        $schoolId = $this->getSchoolId();

        $teachers = Teacher::where('school_id', $schoolId)->get();
        $classes = Classes::all();
        $subjects = Subject::all();

        $teacherId = 1;

        $teacherSubjects = TeacherSubject::select('classes.id', 'classes.class_name', 'subjects.subject_name')
            ->join('teachers', 'teacher_subjects.teacher_id', '=', 'teachers.id')
            ->join('classes', 'teacher_subjects.class_id', '=', 'classes.id')
            ->join('subjects', 'teacher_subjects.subject_id', '=', 'subjects.id')
            ->where('teachers.id', '=', $teacherId)
            ->orderBy('classes.class_name')
            ->get()
            ->groupBy('class_name');

        return view('pages.school_admin.teachers', compact('teachers', 'classes', 'subjects', 'teacherSubjects'));
    }

    public function saveTeacher(Request $request)
    {

        $schoolId = $this->getSchoolId();

        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'required|string|unique:users,phone|max:12',
            'gender' => 'required|string'
        ]);

        // If validation passes, save data to database
        DB::beginTransaction();

        try {
            $user = User::create([
                'firstname' => $data['firstname'],
                'middlename' => $data['middlename'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'phone' => '+255' . $data['phone'],
                'gender' => $data['gender'],
                'password' => Hash::make(strtolower($data['firstname']) . '123'),
                'role_id' => 3
            ]);

            Teacher::create([
                'school_id' => $schoolId,
                'user_id' => $user->id,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Teacher saved successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->withInput()->with('error', 'Failed to save a teacher.');
        }
    }

    public function assignSubject(Request $request)
    {
        $data = $request->validate([
            'teacher_id' => 'required',
            'subject' => 'required',
            'class' => 'required'
        ]);

        $teacherSubject = TeacherSubject::create([
            'teacher_id' => $data['teacher_id'],
            'subject_id' => $data['subject'],
            'class_id' => $data['class']
        ]);

        if (!$teacherSubject) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to assign a teacher to a subject');
        }

        return redirect()
            ->back()
            ->with('success', 'Teacher assigned successfully!');
    }

    public function students()
    {
        return view('pages.school_admin.students');
    }

    public function materials()
    {
        $schoolId = $this->getSchoolId();

        $materials = ExamMaterialDocument::with('teachers')->with('exam_categories')->with('exam_materials')->with('classes')->with('subjects')->get()->toArray();

        // SELECT document FROM exam_material_documents, subjects,classes,users,teachers,exam_materials,examination_categories WHERE exam_material_documents.subject_id = subjects.id AND exam_material_documents.class_id = classes.id AND exam_material_documents.exam_id = examination_categories.id AND exam_material_documents.material_id = exam_materials.id AND teachers.user_id = users.id AND teachers.school_id = 4;

        dd($materials);
        return view('pages.school_admin.materials');
    }
}
