<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function checkUser(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($username == "kitchen" && $password == "kitchen")
        {
            return redirect('/kitchen');
        }

        else if ($username == 'admin' && $password == "admin")
        {
            return redirect('/manager');
        }
        else
        {
            if (auth()->attempt(['username'=>$username,'password'=>$password])){

                $userID = DB::table('users')
                    ->where('username','=',$username)->first()->user_id;

                session(['table' => $userID]);

                return redirect('/menu');
            }
            else
            {
                return back();
            }
        }

    }
}
