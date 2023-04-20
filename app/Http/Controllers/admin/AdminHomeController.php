<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolAdmin;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminHomeController extends Controller
{
    public function index()
    {
        $schools = School::count();
        $users = User::whereNotIn('id', [1])->count();
        $schoolAdmins = User::whereIn('role_id', [2])->count();
        $students = Student::count();
        $subjects = Subject::count();

        $dashboards = [
            ['route' => 'schools', 'class' => 'bg-warning', 'title' => 'School', 'total' => $schools],
            ['route' => 'users', 'class' => 'bg-primary', 'title' => 'Users', 'total' => $users],
            ['route' => 'school-admin', 'class' => 'bg-danger', 'title' => 'School admins', 'total' => $schoolAdmins],
            ['route' => 'subjects', 'class' => 'bg-dark', 'title' => 'Subjects', 'total' => $subjects],
        ];

        return view('pages.admin.home', compact('dashboards'));
    }


    public function Schools()
    {
        $schools = School::all();
        return view('pages.admin.schools', compact('schools'));
    }

    public function saveSchool(Request $request)
    {
        // Validate input data
        $data = $request->validate([
            'index' => 'required|string|unique:schools,index_no',
            'name' => 'required|string|max:255',
        ]);

        // If validation passes, save data to database
        $school = new School;
        $school->index_no = $data['index'];
        $school->school_name = $data['name'];
        $school->save();

        //if fails to save the school
        if (!$school) {
            return redirect()
                ->back()->withInput()
                ->with('error', 'Failed to save a school!');
        }

        // Redirect back with success message
        return redirect()
            ->back()
            ->with('success', 'School saved successfully');
    }

    public function users()
    {
        $users = User::orderBy('role_id')->orderBy('firstname')->with('roles')->get();

        return view('pages.admin.users', compact('users'));
    }

    public function SchoolAdmins()
    {
        $admins = SchoolAdmin::with('users')
            ->with('schools')
            ->orderBy('users.firstname')
            ->join('users', 'users.id', '=', 'school_admins.user_id')
            ->get();
        $schoolIds = $admins->pluck('school_id')->toArray();
        $schools = School::whereNotIn('id', $schoolIds)->get();
        return view('pages.admin.school-admins', compact('schools', 'admins'));
    }

    public function saveAdmin(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'required|string|unique:users,phone|max:10',
            'gender' => 'required|string',
            'school' => 'required|integer|exists:schools,id',
        ]);

        // If validation passes, save data to database
        $user = User::create([
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => '+255' . $data['phone'],
            'gender' => $data['gender'],
            'password' => Hash::make(strtolower($data['firstname']) . '123'),
            'role_id' => 2
        ]);

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Fail to register school admin');
        }

        $admin = SchoolAdmin::create([
            'school_id' => intval($data['school']),
            'user_id' => $user->id,
        ]);

        if ($admin) {
            return redirect()->back()->with('success', 'School admin registered successfully!');
        }
    }

    public function Subjects()
    {
        $subjects = Subject::orderBy('subject_name')->get();
        return view('pages.admin.subjects', compact('subjects'));
    }

    public function saveSubject(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|unique:subjects,subject_name'
        ]);

        $subject = Subject::create([
            'subject_name' => $data['subject']
        ]);

        if (!$subject) {
            return redirect()->back()->withInput()->with('error', 'Failed to save a subject');
        }

        return redirect()->back()->with('success', 'Subject saved successfully!');
    }
}
