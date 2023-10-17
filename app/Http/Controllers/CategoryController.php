<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Social;
use App\Models\Companies;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use function PHPUnit\Framework\at;

class CategoryController extends Controller
{
    public function index(Companies $companies, User $user, Category $category)
    {
        $id = auth()->user()->id;
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $id)->first();
        $categorys = Category::orderBy('order', 'ASC')->paginate(8);
        $categoryRelation = Category::with('product')->get();
        return view('dashboard/category/category')->with(compact('user',
            'company', 'id', 'categorys','categoryRelation'));
    }

    public function category($id, Category $categorys, User $user, Companies $company, Product $product)
    {
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', auth()->user()->id)->first();
        $categorys = Category::where('id', $id)->firstOrFail();
        $products = Product::get()->all();
        return view('dashboard/category/edit')->with(compact('categorys','id','user', 'company', 'products'));
    }

    public function ajaxCategory($id)
    {
        $categoryId = Category::find($id)->first();
        $productrelations = Category::findOrFail($id)->product()->orderBy('product_title')->get();
        return response()->json(['success' => $productrelations]);

    }

    public function createCategory(Category $category, Request $request)
    {
        $request->validate([
           'category_title' => 'required|string',
            'category_desc' => 'required|string',
        ]);
        $user = User::find(auth()->user()->id);
        $id = $user->id;
        $company = Companies::where('user_id', auth()->user()->id)->first();
        $categorys = Category::create([
            'category_title' => $request->category_title,
            'category_description' => $request->category_desc,
        ]);

        $categoryId = $categorys->id;

        return \Redirect::route('category.edit', $categoryId)->with('success', 'Erfolgreich erstellt!');
    }

    public function addCategoryRelations(Category $category, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productId' => 'required|integer',
            'categoryId' => 'required|integer'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'Es ist ein Fehler aufgetaucht',
            ]);
        } else {
            $category = Category::find($request->categoryId);
            $category->product()->syncWithoutDetaching($request->productId);
            return response()->json([
                'status' => 200,
                'success' => 'Erfolgreich hinzugefügt!'
            ]);
        }
    }

    public function deleteCategoryRelations(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'productId' => 'required|integer',
            'categoryId' => 'required|integer',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'error' => 'Es ist ein Fehler aufgetaucht',
             ]);
        } else {
            $category = Category::find($request->categoryId);
            $category->product()->detach($request->productId);
            return response()->json([
                'status' => 200,
                'success' => 'Erfolgreich gelöscht!'
            ]);
        }

    }

    public function categorySave(Request $request, $id, Category $category)
    {

        $request->validate([
            'category_title' => 'required|string',
            'category_description' => 'required|string',
            'picture_upload' => 'nullable|mimes:jpeg,gif,png,svg,jpg|max:5048',
        ]);

        $category = Category::find($id);
        $category->category_title = $request->category_title;
        $category->category_description = $request->category_description;

        if($request->hasFile('picture_upload')) {
            $imageName = time() . '-' . $request->category_title . '.' . $request->picture_upload->extension();
            $request->picture_upload->move(public_path('img/customer/category'), $imageName);
            $category->category_preview_img = $imageName;
        }

        $category->save();

        return back()->with('success', 'Erfolgreich gespeichert!');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->product()->detach();
        $category->save();
        $category->delete();

        return back()->with('success', 'Erfolgreich die Kategorie gelöscht');
    }

    public function searchCategory(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string'
        ]);

        $search = Category::with('product')->where('category_title', 'LIKE', "%$request->search%")->get();

        return response()->json(['data' => $search, 'status' => 200, 'success' => 'Erfolgreich eine suchanfrage gestellt!']);
    }

    public function categoryOrder(Request $request)
    {
        $categorys = Category::all();

        foreach ($categorys as $category) {
            foreach ($request->order as $order) {
                if($order['id'] == $category->id) {
                    $category->update(['order' => $order['position']]);
                }
            }
        }

        return response(['status' => 200, 'success' => 'Erfolgreich die Reihenfolge geändert!']);
    }
}
