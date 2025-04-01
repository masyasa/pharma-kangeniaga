<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = User::all();
        return view('admin.buyers.index', ['buyers' => $buyers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.buyers.create');
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
            'name' => 'required|unique:users|max:255'
        ]);
        if ($validator->fails()) {
            return redirect('/admin/buyers/create')
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::of($request->name)->slug('-');
        $data = $request->all();
        $buyer =  User::create($data);

        Session::flash('status', 'success');
        Session::flash('message', 'Your new buyer was stored!');

        return redirect('admin/buyers');


        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $buyer)
    {

        //tidak apa apa method hasRole undefined, tetep jalan kok
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        // $buyer = User::where('slug', $slug)->first();
        return view('admin.buyers.edit', ['buyer' => $buyer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $buyer)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('buyers')->ignore($buyer),
                'max:255'
            ],
        ]);
        if ($validator->fails()) {
            return redirect('/admin.buyers.edit')
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::of($request['name'])->slug('-');
        $buyer->update($request->all());
        // dd($buyer);
        Session::flash('status', 'success');
        Session::flash('message', "User $buyer->name was updated!");
        return redirect('admin/buyers');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $buyer)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        // $buyer =  User::where('slug', $slug)->first();
        $buyer->delete();
        Session::flash('status', 'success');
        Session::flash('message', "User $buyer->name was deleted!");
        return redirect('admin/buyers');
        dd($buyer);
        //
    }
}
