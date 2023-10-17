<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    public function index(Companies $company, Request $request)
    {
        if(Auth::check()){
            if(auth()->user()->role == 1) {
                return view('admin_register/registercompany');
            } else if(auth()->user()->role == 2) {
                return back()->with('info', 'Du hast schon ein Unternehmen eingerichtet');
            } else if(auth()->user()->role == 3) {
                return back()->with('info', 'Du bist Admin, du brauchst das nicht');
            } else {
                return back()->with('error', 'Keine Berechtigung für diesen Bereich!');
            }
        } else {
            return redirect()->route('login')->with('error', 'Keine Rechte für diesen Bereich!');
        }
    }

    public function registerCompany(Request $request, Companies $company, User $user)
    {
        $request->validate([
            "company_name" => "required|unique:companies|string|max:25",
            "company_owner" => "required|string",
            "country" => "required|string",
            "company_state" => "required|string",
            "company_address" => "required|string",
            "company_place" => "required|string",
            "zip" => "required|string",
            "zip_code" => "required|string",
            "company_number" => "required|string"
        ]);

        if(auth()->user()->role == 1) {
            $userId = auth()
                ->user()
                ->id;

            Companies::create([
                'user_id' => $userId,
                'company_name' => $request->company_name,
                'owner' => $request->company_owner,
                'country' => $request->country,
                'state' => $request->company_state,
                'address' => $request->company_address,
                'address_number' => $request->zip,
                'company_place' => $request->company_place,
                'zip' => $request->zip_code,
                'phone_number' => $request->company_number,
            ]);

            User::where('id', auth()->user()->id)
                ->update(['role' => 2]);

            return redirect()->route('dashboard')->with('success','Erfolgreich Unternehmen und Account erstellt');

        } else {

            return back()->with('error', 'Etwas ist schief gelaufen');

        }

    }

}
