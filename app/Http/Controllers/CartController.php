<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $carts = Cart::all();
        return view('buyer.cart.index', ['carts' => $carts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buyer.cart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:carts|max:255'
        ]);
        if ($validator->fails()) {
            return redirect('/buyer/carts/create')
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::of($request->name)->slug('-');
        $data = $request->all();
        $cart =  Cart::create($data);

        Session::flash('status', 'success');
        Session::flash('message', 'Your new cart was stored!');

        return redirect('buyer/carts');


        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //tidak apa apa method hasRole undefined, tetep jalan kok
        // $cart = Cart::where('slug', $slug)->first();
        return view('buyer.cart.edit', ['cart' => $cart]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('carts')->ignore($cart),
                'max:255'
            ],
        ]);
        if ($validator->fails()) {
            return redirect('/buyer.cart.edit')
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::of($request['name'])->slug('-');
        $cart->update($request->all());
        // dd($cart);
        Session::flash('status', 'success');
        Session::flash('message', "Cart $cart->name was updated!");
        return redirect('buyer/carts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        // $cart =  Cart::where('slug', $slug)->first();
        $cart->delete();
        Session::flash('status', 'success');
        Session::flash('message', "Cart $cart->name was deleted!");
        return redirect('buyer/carts');
        dd($cart);
        //
    }
}
