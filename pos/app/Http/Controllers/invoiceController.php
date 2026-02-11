<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\ProductTransaction;
use Illuminate\Http\Request;

class invoiceController extends Controller
{
    public function index(){
    return view('invoice');

    }
    public function invoice_param($invoice_number)
    {   
        $Transaction = Transaction::where('invoice_number', $invoice_number)->first();
        $ProductTransaction = ProductTransaction::where('invoice_number', $invoice_number)->get();
        return view('invoice',compact('Transaction','ProductTransaction'));
    }
}

