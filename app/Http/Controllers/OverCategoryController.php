<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Companies;
use Illuminate\Http\Request;
use App\Models\OverCategories;

class OverCategoryController extends Controller
{
    public function index(Companies $companies, User $user, Category $category)
    {
        $id = auth()->user()->id;
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $id)->first();
        $categorys = OverCategories::with('categories')->get()->all();

        return view('dashboard.overcategory.index')->with(compact('id','user','company','categorys'));
    }

    public function getData(Request $request, Category $category)
    {
        $id = $request->id;
        $getCategory = OverCategories::where("id", $id)->firstOrFail();
        $getAllCategory = Category::get()->all();
        return response()->json([
            'message' => 'success',
            'category' => $getCategory,
            'allCategory' => $getAllCategory
        ]);
    }

    public function updateData(Request $request)
    {

        $id = $request->id;
        $categoryId = $request->select;
        $name = $request->name;


        $changeCategory = Category::where('over_categories_id', $id)->first();

        if($changeCategory) {
            $changeCategory->over_categories_id = 0;
            $changeCategory->update();
        }

        $findCategory = Category::where('id', $categoryId)->first();
        $findCategory->over_categories_id = $id;
        $findCategory->update();

        $changeOverCategory = OverCategories::where('id', $id)->first();
        $changeOverCategory->name = $name;
        $changeOverCategory->update();


        return response()->json([
            'message' => 'Erfolgreich Geupated'
        ]);

    }

    public function deleteData(Request $request)
    {
        $id = $request->id;

        $getCategory = OverCategories::where("id", $id)->firstOrFail();

        $categories = Category::where("over_categories_id" , $id)->first();
        $categories->over_categories_id = 0;
        $categories->update();

        $getCategory->delete();

        return redirect()->back()->with("message", "Erfolgreich Gelöscht");
    }


    public function createData()
    {
        $category = Category::get()->all();

        return response()->json(['data' => $category]);
    }

    public function create(Request $request)
    {

        $name = $request->name;
        $select = $request->select;

        $request->validate([
            'name' => 'required',
            'select' => 'required'
        ]);

        $categories = OverCategories::create([
            'name' => $name,
        ]);

        $category = Category::where('id', $select)->first();
        $category->over_categories_id = $categories->id;

        return redirect()->back()->with("success", "Überkategorie Erstellt!");

    }
}
