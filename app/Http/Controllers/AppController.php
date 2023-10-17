<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Social;
use App\Models\Companies;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(Companies $companies, User $user, Social $social)
    {
        $id = auth()->user()->id;
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $id)->first();
        $companyId = $company->id;
        $socials = Social::where('company_id', $companyId)->first();
        return view('dashboard/apps/apps')->with(compact('user',
            'company', 'id', 'socials'));
    }

    public function social(Companies $companies, User $user, Social $social, $id)
    {
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $id)->first();
        $companyId = $company->id;
        $socials = Social::where('company_id', $companyId)->first();
        if($company->id == $socials->company_id) {
            return view('dashboard/apps/socialsettings')->with(compact('user',
            'company', 'id', 'socials'));
        }
        return back()->with('error', 'nicht von dir');
    }
    public function socialUpdate(Companies $companies, User $user, Social $social, $id, Request $request)
    {
        $company = Companies::where('user_id', auth()->user()->id)->first();
        $companyId = $company->id;
        $socials = Social::where('company_id', $companyId)->first();
        if($company->id == $socials->company_id) {
            $request->validate([
                'whatsapp' => 'required|string',
                'facebook' => 'required|string',
                'instagram' => 'required|string',
            ]);

           $socials->whatsapp = $request->whatsapp;
           $socials->facebook = $request->facebook;
           $socials->instagram = $request->instagram;
           $socials->save();

           return back()->with('success', 'Erfolgreich übernommen!');
        }
        return back()->with('error', 'nicht von dir');
    }
}
