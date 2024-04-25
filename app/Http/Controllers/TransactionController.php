<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if (Gate::allows('isAdmin')) {
            $totalPembayaranPaid    = Transaction::where('status', 'paid')->sum('total');
            $totalPembayaranUnpaid  = Transaction::where('status', 'unpaid')->sum('total');
            return view('dashboard.transaction.index', [
                'transactions' => Transaction::all(),
                'totalPembayaranPaid' => $totalPembayaranPaid,
                'totalPembayaranUnpaid' => $totalPembayaranUnpaid,
            ]);
        } elseif (Gate::allows('isKaryawan')) {
            // Tampilkan transaksi yang dilakukan oleh pengguna dengan peran "customer"
            // dan transaksi yang dilakukan oleh karyawan itu sendiri
            $transactions = Transaction::where(function ($query) {
                $query->whereHas('order.user', function ($query) {
                    $query->where('role', 'customer');
                })
                ->orWhereHas('order.user', function ($query) {
                    $query->where('role', 'karyawan')
                          ->where('id', Auth::id());
                });
            })->get();
    
            return view('dashboard.transaction.index', [
                'transactions' => $transactions
            ]);
        } else {
            return view('dashboard.transaction.index', [
                'transactions' => Transaction::whereHas('order', function ($query) {
                    $query->where('user_id', Auth::id());
                })->get(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {

        // return dd($transaction);
        // $transaction = Transaction::findOrFail($id);
        // return view('dashboard.transaction.view', compact('transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('transaction.edit', [
            'transaction' => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        if (Gate::allows('isAdmin')) {
            $validatedData = $request->validate([
                'status' => []
            ]);

            if ($request['status']) {
                $validatedData['status'] = 'paid';
            } else {
                $validatedData['status'] = 'unpaid';
            }

            $transaction->update($validatedData);

            return redirect('/transactions');
        } elseif (Gate::allows('isKaryawan')) {
            $validatedData = $request->validate([
                'status' => []
            ]);

            if ($request['status']) {
                $validatedData['status'] = 'paid';
            } else {
                $validatedData['status'] = 'unpaid';
            }

            $transaction->update($validatedData);

            return redirect('/transactions');
        }else {
            $validatedData = $request->validate([
                'image' => ['image', 'file', 'max:4096'],
            ]);

            if ($request->file('image')) {
                $validatedData['image'] = $request->file('image')->store('public_payment');
                $image = $request->file('image');
                $input['imageName'] = $validatedData['image'];
                $destinationPath = public_path('/public_payment');
                $image->move($destinationPath, $input['imageName']);
            }

            $transaction->update($validatedData);

            return redirect('/transactions')->with('update', 'Bukti pembayaran berhasil diunggah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
    public function pay1($id)
    {
            /*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
        composer require midtrans/midtrans-php
                                    
        Alternatively, if you are not using **Composer**, you can download midtrans-php library 
        (https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
        the file manually.   

        require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

        //SAMPLE REQUEST START HERE

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $transaction = Transaction::findOrFail($id); 
        $params = array(
            'transaction_details' => array(
                'order_id' => $transaction->order_id ,
                'gross_amount' => $transaction->total,
            ),
            'customer_details' => array(
                'name'  => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->no_hp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('dashboard.transaction.view', ['snapToken'=>$snapToken,'transaction' => $transaction]);

        
    }
    public function callback(Request $request){
        $serverKey   = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if($hashed== $request->signature_key){
            if($request->transaction_status == 'capture'){
                $order = Transaction::find($request->order_id);
                $order->update(['status'=>'Paid']);
            }
        }
    }
}

