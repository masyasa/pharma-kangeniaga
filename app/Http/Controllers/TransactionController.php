<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();
        return view('admin.transactions.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('buyer')) {
            abort(403, 'Unauthorized action.');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:transactions|max:255'
        ]);
        if ($validator->fails()) {
            return redirect('/buyer/transactions/create')
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::of($request->name)->slug('-');
        $data = $request->all();
        $transaction =  Transaction::create($data);

        Session::flash('status', 'success');
        Session::flash('message', 'Your new transaction was stored!');

        return redirect('admin/transactions');


        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {

        //tidak apa apa method hasRole undefined, tetep jalan kok
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        // $transaction = Transaction::where('slug', $slug)->first();
        return view('admin.transactions.edit', ['transaction' => $transaction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('transactions')->ignore($transaction),
                'max:255'
            ],
        ]);
        if ($validator->fails()) {
            return redirect('/admin.transactions.edit')
                ->withErrors($validator)
                ->withInput();
        }
        $request['slug'] = Str::of($request['name'])->slug('-');
        $transaction->update($request->all());
        // dd($transaction);
        Session::flash('status', 'success');
        Session::flash('message', "Transaction $transaction->name was updated!");
        return redirect('admin/transactions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        if (!Auth::user()->hasRole('owner')) {
            abort(403, 'Unauthorized action.');
        }
        // $transaction =  Transaction::where('slug', $slug)->first();
        $transaction->delete();
        Session::flash('status', 'success');
        Session::flash('message', "Transaction $transaction->name was deleted!");
        return redirect('admin/transactions');
        dd($transaction);
        //
    }
}
