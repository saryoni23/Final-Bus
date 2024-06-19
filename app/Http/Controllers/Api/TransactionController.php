<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
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
