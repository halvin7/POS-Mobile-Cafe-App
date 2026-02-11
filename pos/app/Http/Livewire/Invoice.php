<?php

namespace App\Http\Livewire;
use App\Models\Transaction as TransactionModel;
use Livewire\Component;

class Invoice extends Component
{
    public function render()
    {
        return view('livewire.invoice');
    }
    
    public function invoice_param($invoice_number)
    {   
        $Transaction = TransactionModel::where('invoice_number', 'INV-000042')->first();

        return view('livewire.invoice');
    }

    public function view_invoice()
    {
        return view('livewire.invoice');
    }
}
// public function laporan($id){
//     $transaksi = Transcation::with('productTranscation')->find($id);
//     return view('laporan.transaksi',compact('transaksi'));