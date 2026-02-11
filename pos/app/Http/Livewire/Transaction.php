<?php

namespace App\Http\Livewire;
use App\Models\Transaction as TransactionModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;

class Transaction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $invoice_number,$user_id,$pay,$total,$created_at;
    
    public function render()
    {
        $Transaction = TransactionModel::orderBy('created_at','DESC')->paginate(5);
        return view('livewire.transaction', [
            'Transaction' => $Transaction
        ]);
    }

    use HasFactory;

    protected $fillable =[
        'invoice_number'
    ];

    public function productOrder()
    {
        return $this->hasMany('App\Models\ProductTransaction','invoice_number');
    
    }
    public function next()
    {   
        return redirect('/ProductTransaction');
    }
}

