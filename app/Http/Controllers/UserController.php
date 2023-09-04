<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request){
        $filds = $request->validate([
            'name' => ['required', 'min: 3', 'max: 10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min: 6'],
        ]);

        $filds['password'] = bcrypt($filds['password']);
        $user = User::create($filds);
        auth()->login($user);

        return redirect('/');
    }

    public function login(Request $request){
        $filds = $request->validate([
            'loginemail' => 'required',
            'loginpassword' => 'required',
        ]);

        if(auth()->attempt([ 'email' => $filds['loginemail'], 'password' => $filds['loginpassword']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }


}





