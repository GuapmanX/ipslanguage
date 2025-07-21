<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;


class RegisteredUserController extends Controller
{
    //
    public function create()
    {
        $SupportedLanguages = require(base_path('resources\php\Languages.php'));
        return view('auth.register',[
            'SupportedLanguages' => $SupportedLanguages
        ]);
    }

    public function store()
    {

        //dd(request()->all());
        $Attributes = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', RulesPassword::min(6), 'confirmed'],
            'selected_language' => ['required']
        ]);

        if(array_key_exists('is_admin',request()->all())){
            $Attributes['is_admin'] = true;
        }

        //Check if user doesn't already exist
        $user = User::where('email', '=', $Attributes['email']);
        if($user->exists())
        {
            throw ValidationException::withMessages([
                'email' => 'Account already exists'
            ]);
        }

        $user = User::create($Attributes);
        Auth::login($user);
        return redirect('/');
    }
}
