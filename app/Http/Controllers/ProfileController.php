<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function view($id) {
        $profile = Profile::with('department')->where('id', $id)->first();

        return view('profile.view', compact('profile'));
    }

    public function edit($id) {
        $user = Auth::user();
        $profile = Profile::find($id);
        $departments = Department::all();

        if ($user && $profile->user_id === $user->id) {
            return view('profile.edit', compact('profile', 'departments'));
        } else {
            return abort(403, 'Unauthorized Access');
        }    
    }

    public function update(Request $request, $id) {
        $profile = Profile::find($id);
        $profile->first_name=$request->first_name;
        $profile->middle_name=$request->middle_name;
        $profile->last_name=$request->last_name;
        $profile->update();
        
        $user = Auth::user();

        if ($user && $profile->user_id === $user->id) {
            return redirect()->route('profile.index', ['id' => $id])->with('success', 'Your profile is updated');
        } else {
            return abort(403, 'Unauthorized Access');
        }  
    }
}
