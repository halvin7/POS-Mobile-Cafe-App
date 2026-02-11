<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductTransaction as ProductTransactionModel;

use Livewire\WithPagination;

class Producttransaction extends Component
{
 
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $invoice_number,$product_id,$qty,$created_at;

    public function render()
    {
        
        $ProductTransaction = ProductTransactionModel::orderBy('created_at','DESC')->paginate(5);
        return view('livewire.producttransaction', [
            'ProductTransaction' => $ProductTransaction
        ]);
    }
    public function back()
    {   
        return redirect('/transaction');
    }
}