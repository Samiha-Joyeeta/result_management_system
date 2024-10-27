<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function view()
    {
        return view('login');
    }
    
    public function match(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );
        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('users.login');
    }

    public function create()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'email' => 'required|email:rfc,dns',
                'registration_number' => 'required',
                'password' => ['required', 'confirmed', Password::defaults()],
                'password_confirmation' =>'required',
                'user_type' => 'required',
                'phone_number' => 'required|string|digits:11'
            ]
        );
        $user = new User;
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->registration_number = $request['registration_number'];
        $user->password = md5($request['password']);
        $user->phone_number = $request['phone_number'];
        $user->user_type = $request['user_type'];
        $user->save();

        if($user->user_type != 1)
        {
            $profile = new Profile;
            $profile->registration_number = $request['registration_number'];
            $profile->user_id = $user->id;
            $profile->save();
        }

        return redirect()->route('index')->with('success', 'User Created Successfully');
    }

    public function view_student_dashboard()
    {
        return view('student_dashboard');
    }

    public function view_instructor_dashboard()
    {
        return view('instructor_dashboard');
    }

    public function view_all_users()
    {
        $users = User::all();
        return view('users.view', compact('users'));
    }
}
