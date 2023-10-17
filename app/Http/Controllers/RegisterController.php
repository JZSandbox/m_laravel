<?php

namespace App\Http\Controllers;

use App\Models\Authenticationkey;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('admin_register/registeruser');
    }
    public function registerUser(Request $request, User $user, Authenticationkey $auth)
    {

        $request->validate([
            "surename" => "required|max:25",
            "password" => "required|confirmed",
            "name" => "required|max:25",
            "email" => "required|email|unique:users|confirmed",
            "auth_key" => "required",
        ]);

        /*
         * Get Authentificationtable
         */

        $auths = Authenticationkey::where('authenicationkey', $request->auth_key)->get();

        /*
        * Check if Authentificationkey is used or not
        */

        foreach($auths as $auth) {
            if($auth->used == 1) {

                return back()->with('info', 'Authentifikationsschlüssel wurde bereits verwendet');

            } else {

                User::create([
                    "role" => 1,
                    "forname" => $request->surename,
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                ]);

                Authenticationkey::where('authenicationkey', $request->auth_key)
                    ->update(['used' => 1]);

                auth()->attempt($request->only('email', 'password'));

                return redirect()->route('register_company');
            };
        };

        return back()->with('error', 'Authentifikationsschlüssel existiert nicht');

    }
}
