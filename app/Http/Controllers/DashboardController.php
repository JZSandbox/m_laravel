<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __constructor()
    {
        $this->middleware('auth');
    }

    public function index(User $user, Companies $company)
    {

        if (Auth::check()){
            $id = auth()->user()->id;
            $user = User::find(auth()->user()->id);
            $company = Companies::where('user_id', $id)->first();
            return view('dashboard/dashboard')->with(compact('user',
                'company', 'id'));
        } else {
            return redirect()->route('login');
        }

    }


    public function userSetting(User $user, Companies  $company, $id)
    {

        $company = Companies::where('user_id', $id)->first();

        if($id == auth()->user()->id) {

            $id = auth()->user()->id;
            $user = User::find(auth()->user()->id);
            return view('dashboard/profile/user')->with(compact('user','company', 'id'));

        } else {

            return back()->with('info', 'Keine Berechtung für diese Aktion');

        }

        return view('dashboard/profile/user')->with(compact('company', 'user'));
    }

    public function userUpdate(Request $request, $id)
    {

        if($id == auth()->user()->id) {
            $id = auth()->user()->id;
            $request->validate([
                'image' => 'nullable|mimes:jpeg,gif,png,svg,jpg|max:5048',
                'forname' => 'required|string',
                'name' => 'required|string',
                'email' => 'required|email',
            ]);

            $user = User::findOrFail($id);
            $user->forname = $request->forname;
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->hasFile('image')) {
                $newImageName = auth()->user()->id.'-'.time() . '-' . $request->name . '.' . $request->image->extension();
                $request->image->move(public_path('img/customer/avatar'), $newImageName);
                $user->user_avater_folder = $newImageName;
            }

            $user->save();

            return back()->with('success', 'Erfolgreich Profil gespeichert');

        } else {

            return back()->with('error', 'Keine Berechtigung für diese Aktion!');

        }

        return view('dashboard/profile/user')->with(compact('company', 'user'));

    }

    public function companySetting(User $user,Companies $companies, $id)
    {
        $company = Companies::where('id', $id)->firstOrFail();
        if($company->user_id == auth()->user()->id) {
            $user = User::find(auth()->user()->id);
            return view('dashboard.profile.company')->with(compact('company','user','id'));
        } else {
                return back()->with('error', 'Keine Berechtigung für diese Aktion!');
        }

    }

    public function companySettingUpdate(Companies $companies, $id, Request $request)
    {
        $checkId = auth()->user()->id;
        $companies = Companies::where('user_id', $id)->first();
        if($checkId == $companies->user_id) {
            $request->validate([
                'company' => 'required|string',
                'company_owner' => 'required|string',
                'country' => 'required|string',
                'state' =>  'required|string',
                'street' => 'required|string',
                'address_number' => 'required|string',
                'zip' => 'required|string',
                'city' => 'required|string',
                'number' => 'required|string',
                'image_company' => 'nullable|mimes:jpeg,jpg,svg,png|max:5048'
            ]);

            if($request->hasFile('image_company')){

                $imageName = auth()->user()->id.'-'.time() . '-' . $request->company_name . '.' . $request->image_company->extension();
                $request->image_company->move(public_path('img/company/logo/'), $imageName);
                $companies->company_logo_folder = $imageName;

            }

            $companies->company_name = $request->company;
            $companies->owner = $request->company_owner;
            $companies->country = $request->country;
            $companies->state = $request->state;
            $companies->address = $request->street;
            $companies->address_number = $request->address_number;
            $companies->zip = $request->zip;
            $companies->phone_number = $request->number;
            $companies->company_place = $request->city;

            $companies->save();

            return back()->with('success', 'Erfolgreich geupdated!');
        } else {
            return back()->with('error', 'Keine Berechtigung');
        }

    }
}
