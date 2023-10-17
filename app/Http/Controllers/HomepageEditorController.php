<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Companies;

class HomepageEditorController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $id)->first();

        return view('dashboard/editorsite/index')->with(compact( 'user','id','company'));
    }
    public function homesite()
    {

    }

}
