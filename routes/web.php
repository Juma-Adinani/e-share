<?php

use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\schooladmin\SchoolAdminController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\student\StudentDashboardController;
use App\Http\Controllers\teacher\TeacherDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'getRoles'])->name('dashboard');
});

//admin routes
Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('home');
Route::get('/admin/schools', [AdminHomeController::class, 'Schools'])->name('schools');
Route::get('/admin/subjects', [AdminHomeController::class, 'Subjects'])->name('subjects');
Route::get('/admin/school-admins', [AdminHomeController::class, 'schoolAdmins'])->name('school-admin');
Route::get('/admin/users', [AdminHomeController::class, 'users'])->name('users');

Route::post('/admin/school/save', [AdminHomeController::class, 'saveSchool'])->name('save-school');
Route::post('/admin/school-admins/save', [AdminHomeController::class, 'saveAdmin'])->name('save-admin');
Route::post('/admin/subject/save', [AdminHomeController::class, 'saveSubject'])->name('save-subject');

// school admin routes
Route::get('/school-admin/home', [SchoolAdminController::class, 'index'])->name('sa-home');
Route::get('/school-admin/teachers', [SchoolAdminController::class, 'teachers'])->name('teachers');
Route::get('/school-admin/students', [SchoolAdminController::class, 'students'])->name('students');
Route::get('/school-admin/materials', [SchoolAdminController::class, 'materials'])->name('materials');

Route::post('/school-admin/teachers/save', [SchoolAdminController::class, 'saveTeacher'])->name('save-teacher');
Route::post('/school-admin/teachers/assign-subject', [SchoolAdminController::class, 'assignSubject'])->name('assign-subject');

// teacher routes
Route::get('/teacher/home', [TeacherDashboardController::class, 'index'])->name('t-home');
Route::get('/teacher-materials', [TeacherDashboardController::class, 'materials'])->name('teacher-materials');

Route::post('/teacher/material/save', [TeacherDashboardController::class, 'uploadMaterial'])->name('save-material');


// student routes
Route::get('/student/select-school', [AuthController::class, 'selectSchoolForm'])->name('select-school');
Route::get('/student/home', [StudentDashboardController::class, 'index'])->name('st-home');
Route::get('/student/schools', [StudentDashboardController::class, 'schools'])->name('school-list');

Route::post('/student/select-school/save', [AuthController::class, 'selectSchool'])->name('student-school');

//school routes
Route::get('/school/{schoolid}/school-materials', [SchoolController::class, 'getMaterials'])->name('school-materials');
Route::get('/school/materials/{materialid}/detail', [SchoolController::class, 'materialDetail'])->name('material-detail');


// shared routes
Route::get('/register', [AuthController::class, 'register_form'])->name('register');
Route::get('/login', [AuthController::class, 'login_form'])->name('login');
Route::post('/register-user', [AuthController::class, 'register'])->name('registeruser');
Route::post('/login-user', [AuthController::class, 'login'])->name('loginuser');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/blank', function(){
    return view('blankPage');
});
Route::any('{query}', function () {
    return view('/pages/auth/404');
})->where('query', '.*');
