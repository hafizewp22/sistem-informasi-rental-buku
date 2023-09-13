<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile() {

        return view('profile');
    }

    public function index() {
        $users = User::where('role_id', 2)->where('status', 'active')->get();

        return view('user', compact('users'));
    }

    public function registeredUser() {
        $registeredUser = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('registerd-user', compact('registeredUser'));
    }

    public function show($slug) {
        $user = User::where('slug', $slug)->first();
        return view('user-detail', compact('user'));
    }

    public function approve($slug) {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();

        return redirect('user-detail/'.$slug)->with('status', 'User Approved Successfull');
    }
}
