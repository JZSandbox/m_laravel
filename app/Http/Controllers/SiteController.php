<?php

namespace App\Http\Controllers;

use App\Models\AboutSite;
use App\Models\Companies;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\HomeSite;

class SiteController extends Controller
{
    public function home()
    {
        $id = auth()->user()->id;
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $id)->first();
        $homeSite = HomeSite::where('id', 1)->firstOrFail();

        return view('dashboard/editorsite/homesite')->with(compact( 'user','id','company', 'homeSite'));
    }

    public function homeEdit($id, Request $request)
    {
        $homeSite = HomeSite::where('id', $id)->firstOrFail();


        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'wartungs' => 'boolean',
            'preloader' => 'boolean',
            'picture_upload' => 'nullable|mimes:jpeg,png,jpg,svg|max:5023'
        ]);

        if(!isset($request->wartungs)) {
            $request->wartungs = 0;
        }

        if(!isset($request->preloader)) {
            $request->preloader = 0;
        }

        if(!isset($request->togglePicture)) {
            $request->togglePicture = 0;
        }

        if($request->hasFile('picture_upload')) {
            $imageName = auth()->user()->id.'-'.time()  . '.' . $request->picture_upload->extension();
            $request->picture_upload->move(public_path('img/website/front'), $imageName);
            $homeSite->img_path = $imageName;
        }

        $homeSite->title = $request->title;
        $homeSite->description = $request->description;
        $homeSite->wartungs = $request->wartungs;
        $homeSite->preloader = $request->preloader;
        $homeSite->image_toggle = $request->togglePicture;
        $homeSite->save();

        return back()->with('success', 'Erfolgreich deine Seite gespeichert');

    }

    public function aboutUs()
    {
        $id = auth()->user()->id;
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $id)->first();
        $aboutSite = AboutSite::where('id', 1)->firstOrFail();

        return view('dashboard/editorsite/aboutus')->with(compact( 'user','id','company', 'aboutSite'));
    }
    public function aboutUsEdit($id, Request $request)
    {
        $aboutSite = AboutSite::where('id', $id)->firstOrFail();

        $request->validate([
            'big_title' => 'required|string',
            'small_title' => 'required|string',
            'text_1' => 'required|string',
            'text_2' => 'required|string',
            'text_3' => 'required|string',
        ]);

        $aboutSite->big_title = $request->big_title;
        $aboutSite->small_title = $request->small_title;
        $aboutSite->text_1 = $request->text_1;
        $aboutSite->text_2 = $request->text_2;
        $aboutSite->text_3 = $request->text_3;
        $aboutSite->save();

        return back()->with('success', 'Erfolgreich deine Seite gespeichert');
    }
}
