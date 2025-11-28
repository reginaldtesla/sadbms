<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


     // Handle logout functionality
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/');
    }


    //Handle signup functionality
public function register(Request $request){
    $incommingFields = $request->validate([
        'name' => ['required','min:3','max:10',Rule::unique('users','name')],
        'email' => ['required','email',Rule::unique('users','email')],
        'password' => ['required','string','min:3','max:10'],
        'confirm-password' => ['required','same:password'],
    ]);
    $incommingFields['password'] = bcrypt($incommingFields['password']);
    User::create($incommingFields);
    // auth()->login($user);
    return response("<script>alert('Registration successful. Please log in.'); window.location.href = '/';</script>");
}


    //Handle login functionality
    public function login(Request $request){
        $incommingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required',
        ]);
        if (auth()->attempt(['name'=>$incommingFields['loginname'],'password'=>$incommingFields['loginpassword']]) ){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return redirect('/');
    }

}
