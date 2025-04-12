<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Department;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;


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

    public function view_all_users(Request $request)
    {
        $departments = Department::all();
        $semesters = Semester::all();
        $query = User::query();

        if ($request->filled('user_type')) {
            $query->where('user_type', $request->user_type);
        }

        if ($request->filled('order')) {
            $query->orderBy('created_at', $request->order);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('username', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        $users = $query->paginate(10);

        return view('users.view', compact('users', 'departments', 'semesters'));
    }

    public function student_list()
    {
        $users = User::where('user_type', '3')->paginate(10);
        return view('users.type_user_view', compact('users'));
    }

    public function instructor_list()
    {
        $users = User::where('user_type', '2')->paginate(10);
        return view('users.type_user_view', compact('users'));
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'username' => [
                    'required',
                    'unique:users,username',
                    'regex:/^\S*$/'
                ],
                'email' => 'required|email:rfc,dns|unique:users,email',
                'registration_number' => 'required|unique:users,registration_number',
                'password' => ['required', 'confirmed', Password::defaults()],
                'password_confirmation' =>'required',
                'user_type' => 'required',
                'phone_number' => [
                    'required',
                    'string',
                    'regex:/^([0-9\s\-]*)$/',
                    'min:11',
                    'unique:users,phone_number'
                ]
            ]
        );
        
        $user = new User;
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->registration_number = $request['registration_number'];
        $user->password = md5($request['password']);
        $user->phone_number = $request['phone_number'];
        $user->user_type = $request['user_type'];
        $user->status = User::USER_STATUS_ACTIVE;
        $user->save();

        if ($user->user_type != User::USER_TYPE_ADMIN) {
            $profile = new Profile;
            $profile->registration_number = $request['registration_number'];
            $profile->department_id = $request['department_id'];
            $profile->session = $request['session'];
            $profile->semester_id = $request['semester_id'];
            $profile->user_id = $user->id;
            $profile->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user,
        ], 200);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);

        $request->validate(
            [
                'username' => [
                    'required',
                     Rule::unique('users', 'username')->ignore($user->id),
                    'regex:/^\S*$/'
                ],
                'email' => [
                    'required',
                    'email:rfc,dns',
                    Rule::unique('users', 'email')->ignore($user->id)
                ],
                'registration_number' => [
                    'required',
                    Rule::unique('users', 'registration_number')->ignore($user->id)
                ],
                'user_type' => 'required',
                'phone_number' => [
                    'required',
                    'string',
                    'regex:/^([0-9\s\-]*)$/',
                    'min:11',
                    Rule::unique('users', 'phone_number')->ignore($user->id)
                ]
            ]
        );
    
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->registration_number = $request['registration_number'];
        $user->phone_number = $request['phone_number'];
        $user->user_type = $request['user_type'];
        $user->status = $request['status'];
        $user->update();

        return response()->json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            $user->delete();

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }
    }
}
