<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Utils;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __constructor()
    {
        $this->middleware('guest');
    }
    public function index(User $user)
    {
        if(Auth::check()){
            if(auth()->user()->role == 1) {
                return view('admin_register/registercompany')->with('info', 'Bitte Unternehmen erstellen');
            } else if(auth()->user()->role == 2) {
                return back()->with('info', 'Du hast schon ein Unternehmen eingerichtet');
            } else if(auth()->user()->role == 3) {
                return back()->with('info', 'Du bist Admin, du brauchst das nicht');
            } else {
                return back()->with('error', 'Keine Berechtigung für diesen Bereich!');
            }
        } else {
            return view('admin_login/login');
        }

    }

    public function logout()
    {
        if(Auth::check()){
            auth()->logout();

            return redirect()->route('login')->with('success', 'Erfolgreich ausgeloggt');
        }

        return back()->with('info', 'Sie sind nicht eingeloggt');

    }
    public function login(Request $request)
    {
        $this->validate($request, [
           "email" => "required|email",
           "password" => "required",
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Falsches Passwort oder E-Mail');
        };

        if(auth()->user()->role == 1){
            return redirect()->route('register_company');
        } else {
            return redirect()->route('dashboard')->with('success', 'Erfolgreich Eingeloggt');
        }
    }
}
