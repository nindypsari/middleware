<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //login
    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'

        ]);

        if (Auth::attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();

        }
        return redirect('/home');
    }

    //logout
    public function logout()  {
        Auth::logout();
        return redirect('/home');
    }
    //untuk registrasi
    public function register (Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10'], // harus diisi dan min 3 karakter max 10
            'email' => ['required'], // harus diisi dengan format email
            'password' => ['required','min:8', 'max:10'], // harus diisi dengan min 8 karakter max 10 karakter
            'role' => ['required', 'string', 'in:admin,user']

        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']); //enkripsi password
        $user = User::create($incomingFields); // membuat user baru
        Auth::login($user); //langsung login setelah register
        return redirect ('/home') ;
    }
}
