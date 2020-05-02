<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function checkUser(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if (auth()->attempt(['username'=>$username,'password'=>$password])){

            session(['table' => $username]);

            return redirect('/menu');
        }

    }
}
