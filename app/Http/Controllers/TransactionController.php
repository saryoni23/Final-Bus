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

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        //Override Notification URL
        \Midtrans\Config::$overrideNotifUrl = config('app.url').'/api/midtrans-callback';

        $transaction = Transaction::findOrFail($id); 
        $params = array(
            'transaction_details' => array(
                'order_id' => $transaction->id_order,
                'gross_amount' => $transaction->total,
            ),
            'customer_details' => array(
                'first_name'    => Auth::user()->name,
                'last_name'     => '',
                'email' => Auth::user()->email,
                'phone' => Auth::user()->no_hp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        #return dd($snapToken);
        return view('dashboard.transaction.view', ['snapToken'=>$snapToken,'transaction' => $transaction]);

    }
    public function callback(Request $request){
        $serverKey   = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if($hashed== $request->signature_key){
            if($request->transaction_status =='capture' or $request->transaction_status == 'settlement'){
                $order = Transaction::find($request->id);
                $order->update(['status'=>'paid']);
            }
        }
    }
}

