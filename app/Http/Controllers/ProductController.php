<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Companies;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        $id = auth()->user()->id;
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $id)->first();
        $products = Product::paginate(8);
        $productsRelations = Product::with('category')->get();

       return view('dashboard/product/index')->with(compact( 'products','user','id','company','productsRelations'));
    }

    public function create(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $id)->first();

        $request->validate([
            'product_title' => 'required|string',
            'product_desc' => 'required|string',
            'product_price' => 'required|integer',
        ]);

        $productCreate = Product::create([
            'product_title' => $request->product_title,
            'product_price' => $request->product_price,
            'product_desc' => $request->product_desc,
        ]);

        $ProductId = $productCreate->id;

        return \Redirect::route('product.edit', $ProductId)->with('success', 'Erfolgreich erstellt!');
    }

    public function edit($id)
    {

        $user = User::find(auth()->user()->id);
        $company = Companies::where('user_id', $user->id)->first();
        $product = Product::with('category')->where('id', $id)->first();
        $categorys = Category::get()->all();
        return view('dashboard/product/edit')->with(compact('id', 'company','product','user', 'categorys'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->category()->detach();
        $product->save();
        $product->delete();

        return back()->with('success', 'Erfolgreich Produkt gelöscht!');
    }
    public function save($id, Request $request)
    {

        $request->validate([
           'product_title' => 'required|string',
            'product_desc' => 'required|string',
            'product_price' => 'required|integer',
            'product_preview_img' => 'nullable|mimes:png,jpeg,gif,svg,jpg|max:5048',
        ]);

        $product = Product::findOrFail($id);
        $product->product_title = $request->product_title;
        $product->product_desc = $request->product_desc;
        $product->product_price = $request->product_price;
        if($request->hasFile('picture_upload')) {
            $imageName = time().'-'.$request->product_title.'-'.$request->file('picture_upload')->getClientOriginalExtension();
            $request->picture_upload->move(public_path('img/customer/product'), $imageName);
            $product->product_preview_img = $imageName;
        }

        $product->save();

        return back()->with('success', 'Erfolgreich Gespeichert!');
    }
    public function fetchTable($id)
    {
        $fetchData = Product::findOrFail($id)->category()->get();
        return response()->json(['success' => 'Erfolgreich gefeteched', 'data' => $fetchData]);
    }

    public function addPR(Product $product, Request $request)
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
            $product = Product::find($request->productId);
            $product->category()->syncWithoutDetaching($request->categoryId);
            return response()->json([
                'status' => 200,
                'success' => 'Erfolgreich hinzugefügt!'
            ]);
        }
    }

    public function dPR(Request $request, Product $product)
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
            $product = Product::find($request->productId);
            $product->category()->detach($request->categoryId);
            return response()->json([
                'status' => 200,
                'success' => 'Erfolgreich gelöscht!'
            ]);
        }

    }

    public function searchProduct(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string'
        ]);

        $search = Product::with('category')->where('product_title', 'LIKE', "%$request->search%")->get();

        return response()->json(['data' => $search, 'status' => 200, 'success' => 'Erfolgreich eine suchanfrage gestellt!']);
    }
}

