<?php

namespace App\Http\Controllers;

use App\Models\AboutSite;
use App\Models\Category;
use App\Models\Companies;
use App\Models\HomeSite;
use App\Models\OverCategories;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Models\Product;

class HomePageController extends Controller
{
    public function index()
    {

        $categorys = Category::with('product')->get();
        $company = Companies::where('user_id', 5)->first();
        $over = OverCategories::with('categories')->get();
        $categorysProduct =  Category::with('product')->get();
        $categorysCount = Category::count();
        $socials = Social::where("company_id", $company->id)->first();
        $aboutUs = AboutSite::where("id", 1)->first();
        $homeSite = HomeSite::where('id', 1)->firstOrFail();
        $categorysFull =  Category::with('product')->get();
        $wartungs = $homeSite->wartungs;
        $preloader = $homeSite->preloader;
        $wartungsText = 'Im Bearbeitungsmodus';

        if(!$wartungs) {
            return view('homepage.index.index')->with(compact('categorys', 'company', 'categorysProduct', 'socials','preloader', 'aboutUs','categorysCount','homeSite','categorysFull','over'));
        } else {
            if(auth()->user()) {
                return view('homepage.index.index')->with(compact('categorys', 'company', 'categorysProduct', 'socials','preloader', 'aboutUs','categorysCount','homeSite','categorysFull','wartungsText','over'));
            }
            return view('homepage.preloader.index')->with(compact('categorys', 'company', 'categorysProduct'));
        }
    }

    public function showProduct($id)
    {
        $company = Companies::where('user_id', 5)->first();
        $socials = Social::where('company_id', $company->id)->first();
        $aboutUs = AboutSite::where("id", 1)->first();
        $company = Companies::where('user_id', 5)->first();
        $homeSite = HomeSite::where('id', 1)->firstOrFail();

        $product = Product::where('id',$id)->with('category')->first();

        $wartungs = $homeSite->wartungs;
        $preloader = $homeSite->preloader;


        return view('homepage.index.product')->with(compact('company', 'socials','preloader', 'aboutUs','homeSite', 'product'));

    }
}
