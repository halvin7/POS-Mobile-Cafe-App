<?php

namespace App\Http\Livewire;

use App\Models\Membership;
use Livewire\Component;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Livewire\WithPagination;
use DB;
use Illuminate\Http\Request;
use App\Models\Product as ProductModel;
use App\Models\Transaction;
use App\Models\ProductTransaction;



class Cart extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $tax = "0%";

    public $point = "0%";

    public $method;

    public $Customer;

    public $search;

    public $payment = 0;

    public function updatingSearch()
    {
        $this->resetPage();
    }    

    

    public function render()
    {
        $Customer=DB::table('membership')->get();
        

        $products = ProductModel::where('category', 'like', '%'.$this->search.'%')->orderBy('created_at', 'DESC')->paginate(12);

        $condition = new \Darryldecode\Cart\CartCondition([
            'name' => 'pajak',
            'type' => 'tax',
            'target' => 'total',
            'value' => $this->tax,
            'order' => 1
        ]);

        $condition1 = new \Darryldecode\Cart\CartCondition([
            'name' => 'point',
            'type' => 'point',
            'value' => $this->point,
            'order' => 1
        ]);

        \Cart::session(Auth()->id())->condition($condition);
        $items = \Cart::session(Auth()->id())->getContent()->sortBy(function ($cart) {
            return $cart->attributes->get('added_at');
        });

        \Cart::session(Auth()->id())->condition($condition1);
        $items = \Cart::session(Auth()->id())->getContent()->sortBy(function ($cart) {
            return $cart->attributes->get('added_at');
        });

        if(\Cart::isEmpty()){
            $cartData = [];
        }else{
            foreach($items as $item){
                $cart[] = [
                    'rowId' => $item->id,
                    'name' => $item->name,
                    'qty' => $item->quantity,
                    'pricesingle' => $item->price,
                    'price' => $item->getPriceSum(),
                ];
            }
            
            $cartData = collect($cart);
        }

        $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();

        $newCondition = \Cart::session(Auth()->id())->getCondition('pajak');
        $pajak = $newCondition->getCalculatedValue($sub_total);
        $newCondition1 = \Cart::session(Auth()->id())->getCondition('point');
        $point = $newCondition1->getCalculatedValue($sub_total);

        $summary = [
            'sub_total' => $sub_total,
            'pajak' => $pajak,
            'point' =>$point,
            'total' => $total
        ];

        return view('livewire.cart', [
            'products' => $products,
            'carts' => $cartData,
            'summary' => $summary,
            'customer'=> $Customer,           
        ]);
    }

    public function addItem($id){
        $rowId = "Cart".$id;
        
        
        $cart = \Cart::session(Auth()->id())->getContent();
        $cekItemId = $cart->whereIn('id', $rowId);

        $idProduct = substr($rowId, 4,5 ); //perlu diadjust lagi
        $product = ProductModel::find($idProduct);

        if($cekItemId->isNotEmpty()){
            if($product->qty == $cekItemId[$rowId]->quantity){
                session()->flash('error', 'Out of Stock');
            }else{
                \Cart::session(Auth()->id())->update($rowId, [
                    'quantity' => [
                        'relative' => true,
                        'value' => 1
                    ]
                ]);
            }
        }else{
            if($product->qty == 0){
                session()->flash('error', 'Out of Stock');
            }else{
                \Cart::session(Auth()->id())->add([
                    'id' => "Cart".$product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'attributes' => [
                        'added_at' => Carbon::now()
                    ],
                ]);
            }
            
        }
    }

    public function enableTax(){
        $this->tax = "+10%";
    }

    public function disableTax(){
        $this->tax = "0%";
    }

    public function enablePoint(){
        $this->point = "+10%";
    }

    public function disablePoint(){
        $this->point = "0%";
    }

    public function increaseItem($rowId){
        $idProduct = substr($rowId, 4,5 );
        $product = ProductModel::find($idProduct);

        $cart = \Cart::session(Auth()->id())->getContent();

        $checkItem = $cart->whereIn('id', $rowId);
        
        if($product->qty == $checkItem[$rowId]->quantity || $product->qty == 0){
            session()->flash('error', 'Out of Stock');
        }else{
            if($product->qty == 0){
                session()->flash('error', 'Out of Stock');
            }else{
                \Cart::session(Auth()->id())->update($rowId, [
                    'quantity' => [
                        'relative' => true,
                        'value' => 1
                    ]
                ]);  
            }
        }       
    }

    public function decreaseItem($rowId){ 
        $idProduct = substr($rowId, 4,5 );
        $product = ProductModel::find($idProduct);

        $cart = \Cart::session(Auth()->id())->getContent();

        $checkItem = $cart->whereIn('id', $rowId);

        if($checkItem[$rowId]->quantity == 1){
            $this->removeItem($rowId);
        }else{
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => -1
                ]
            ]);
        }      
    }

    public function removeItem($rowId){  
        \Cart::session(Auth()->id())-> remove($rowId);
    }


    public function handleSubmit(Request $request) {
        // $idCustomer = $request->input('datacustomer');

        $cartTotal = \Cart::session(Auth()->id())->getTotal();
        $bayar = $this->payment;
        $kembalian = (int) $bayar - (int) $cartTotal;
       $pointcustomer = Membership::all()->where('id', $this->Customer)->pluck('point');
        $total = (int) $cartTotal * 10/100 + $pointcustomer->first();
        if($kembalian >= 0){
            DB::beginTransaction();

            try {

                $addpoint = DB::table('membership')->where('id', $this->Customer)->update([
                    'point' =>    $total
                ]);

                $allCart = \Cart::session(Auth()->id())->getContent();

                $filterCart = $allCart->map(function ($item) {
                    return [
                        'id' => substr($item->id, 4,5 ),
                        'quantity' => $item->quantity
                    ];
                });

                foreach ($filterCart as $cart) {
                    $product = ProductModel::find($cart['id']);

                    if($product->qty === 0){
                        return session()->flash('error', 'Out of Stock');
                    }

                    $product->decrement('qty', $cart['quantity']);
                }

                $id = IdGenerator::generate([
                    'table' => 'transactions',
                    'length' => 10,
                    'prefix' => 'INV-',
                    'field' => 'invoice_number'                    
                ]);
                if ($this->method == "2") { //Pembayaran Point
                    $JumlahTransaksi = (int) $cartTotal;
                    if($pointcustomer->first() >= $JumlahTransaksi)
                    {
                        $kuranginPoint = DB::table('membership')->where('id', $this->Customer)->update([
                            'point' =>  $pointcustomer->first() - $bayar
                        ]);
                        Transaction::create([
                            'invoice_number' => $id,
                            'user_id' => Auth()->id(),
                            'pay' => $bayar,
                            'total' => $cartTotal
                        ]);
                    }
                else{
                    return session()->flash('error', "Your points are not enough to make a transaction");
                }
                }
                else { //Pembayaran Cash
                    $addpoint = DB::table('membership')->where('id', $this->Customer)->update([
                        'point' =>    $total
                    ]);
                    Transaction::create([
                        'invoice_number' => $id,
                        'user_id' => Auth()->id(),
                        'pay' => $bayar,
                        'total' => $cartTotal
                    ]);
                }

                foreach ($filterCart as $cart) {
                    ProductTransaction::create([
                        'product_id' => $cart['id'],
                        'invoice_number' => $id,
                        'qty' => $cart['quantity']
                    ]);
                }

                \Cart::session(Auth()->id())->clear();
                $this->payment = 0;

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return session()->flash('error', $th);
            }
        }
    }
}