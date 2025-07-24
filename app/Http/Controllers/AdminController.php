<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {

        $currentUser = Auth::user();

        if(!$currentUser->is_admin)
        {
            return redirect('/');
        }

        $users = User::where('is_admin', false)->get(); //gets only non admin users

        return view('admin-panel',[
                'email' => $currentUser->email,
                'Language' => $currentUser->selected_language,
                'is_admin' => $currentUser->is_admin,
                'users' => $users
             ]);
    }
}
