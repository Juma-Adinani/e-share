<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register_form()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'gender' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => '+255' . $request->phone,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'role_id' => 4,
        ]);

        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Welcome!');
        }

        return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again.');
    }

    public function login_form()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $authenticatedUser = Auth::user();
            session()->put([
                'id' => $authenticatedUser->id,
                'username' => $authenticatedUser->firstname . ' ' . $authenticatedUser->lastname,
                'roleId' => $authenticatedUser->role_id,
                'email' => $authenticatedUser->email,
                'phone' => $authenticatedUser->phone,
            ]);
            if (session('roleId') == 1) {
                return redirect()->intended('/admin/home')->with('success', session('username'));
            }
            if (session('roleId') == 2) {
                return redirect()->intended('/school-admin/home')->with('success', session('username'));
            }
            if (session('roleId') == 3) {
                return redirect()->route('t-home')->with('success', session('username'));
            }
            if (session('roleId') == 4) {
                return redirect()->intended('/student/home')->with('success', session('username'));
            }
        } else {
            $errorMessage = __('auth.failed');
            return back()->withInput()->withErrors([
                'error' => $errorMessage,
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->intended('/login');
    }

    public function selectSchoolForm()
    {
        $schools = School::all();
        $classes = Classes::all();
        return view('pages.auth.select_school', compact('schools', 'classes'));
    }
}
