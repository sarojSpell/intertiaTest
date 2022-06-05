<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function showRegisterForm(){
        return Inertia::render('Auth/register');
    }
    public function register(Request $request){
        $this->validate($request,[
            'name'=>['required','max:100'],
            'email'=>['required','email','max:100'],
            'password'=>['required','min:4'],
        ]);
        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        $user->save();
        $request->session()->flash('success', 'User registered successfully! you can sign in now');
        return Redirect::route('showLoginForm');
    }
}
