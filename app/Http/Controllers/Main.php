<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Main extends Controller
{
    //
    public function index()
    {
        $currentUser = Auth::user();

        return view('home',[
              'email' => $currentUser->email,
              'Language' => $currentUser->selected_language,
              'is_admin' => $currentUser->is_admin
             ]);
    }
}
