<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(Companies $company, User $user, )
    {
        $id = auth()->user()->id;
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $id)->first();
        return view('dashboard/settings/setting')->with(compact('user',
            'company', 'id'));

    }
}
