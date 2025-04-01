<?php

namespace App\Http\Controllers;

use App\Models\ProductTransaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_transactions = ProductTransaction::all();
        return view('admin.product_transactions.index', ['product_transactions' => $product_transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product_transactions.create');
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
            'name' => 'required|unique:product_transactions|max:255'
        ]);
        if ($validator->fails()) {
            return redirect('/admin/product_transactions/create')
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::of($request->name)->slug('-');
        $data = $request->all();
        $product_transaction =  ProductTransaction::create($data);

        Session::flash('status', 'success');
        Session::flash('message', 'Your new product transaction was stored!');

        return redirect('admin/product_transactions');


        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductTransaction $product_transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTransaction $product_transaction)
    {

        //tidak apa apa method hasRole undefined, tetep jalan kok
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        // $product_transaction = ProductTransaction::where('slug', $slug)->first();
        return view('admin.product_transactions.edit', ['product_transaction' => $product_transaction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductTransaction $product_transaction)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('product_transactions')->ignore($product_transaction),
                'max:255'
            ],
        ]);
        if ($validator->fails()) {
            return redirect('/admin.product_transactions.edit')
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::of($request['name'])->slug('-');
        $product_transaction->update($request->all());
        // dd($product_transaction);
        Session::flash('status', 'success');
        Session::flash('message', "ProductTransaction $product_transaction->name was updated!");
        return redirect('admin/product_transactions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTransaction $product_transaction)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        // $product_transaction =  ProductTransaction::where('slug', $slug)->first();
        $product_transaction->delete();
        Session::flash('status', 'success');
        Session::flash('message', "ProductTransaction $product_transaction->name was deleted!");
        return redirect('admin/product_transactions');
        dd($product_transaction);
        //
    }
}
