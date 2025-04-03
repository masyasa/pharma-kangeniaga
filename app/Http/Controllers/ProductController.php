<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        // $categories = Product::with('batuk')->find(1)->categories;
        // dd($categories);
        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::all();
        return view('admin.products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:255'
        ]);
        if ($validator->fails()) {
            return redirect('/admin/products/create')
                ->withErrors($validator)
                ->withInput();
        }

        $request['slug'] = Str::of($request->name)->slug('-');
        $data = $request->all();
        // dd($data);

        $product =  Product::create($data);

        $product->categories()->sync($request->categories);

        Session::flash('status', 'success');
        Session::flash('message', 'Your new product was stored!');

        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        // $category = Category::where('slug', $slug)->first();
        return view('admin.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('products')->ignore($product),
                'max:255'
            ],
        ]);
        if ($validator->fails()) {
            return redirect('/admin.products.edit')
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::of($request['name'])->slug('-');
        $product->update($request->all());
        // dd($category);
        Session::flash('status', 'success');
        Session::flash('message', "Product $product->name was updated!");
        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        $product->delete();
        // dd($product);

        Session::flash('status', 'success');
        Session::flash('message', "Product $product->name was deleted!");
        return redirect('admin/products');
    }
}
