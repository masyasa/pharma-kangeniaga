<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.categories.create');
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
            'name' => 'required|unique:categories|max:255'
        ]);
        if ($validator->fails()) {
            return redirect('/admin/categories/create')
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::of($request->name)->slug('-');
        $data = $request->all();
        $category =  Category::create($data);

        Session::flash('status', 'success');
        Session::flash('message', 'Your new category was stored!');

        return redirect('admin/categories');


        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //tidak apa apa method hasRole undefined, tetep jalan kok
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        // $category = Category::where('slug', $slug)->first();
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('categories')->ignore($category),
                'max:255'
            ],
        ]);
        if ($validator->fails()) {
            return redirect('/admin.categories.edit')
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::of($request['name'])->slug('-');
        $category->update($request->all());
        // dd($category);
        Session::flash('status', 'success');
        Session::flash('message', "Category $category->name was updated!");
        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        // $category =  Category::where('slug', $slug)->first();
        $category->delete();
        Session::flash('status', 'success');
        Session::flash('message', "Category $category->name was deleted!");
        return redirect('admin/categories');
        dd($category);
        //
    }
}
