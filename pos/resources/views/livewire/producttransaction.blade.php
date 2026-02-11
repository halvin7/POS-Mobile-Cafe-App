<div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Product History</h2>
                    <table class="table table-bordered table-hovered table-striped"> 
                        <thead>
                            <tr class="text-center">
                                <th>Invoice Number</th>
                                <th>Product ID</th>
                                <th>Purchased Items</th>
                                <th>Date</th>
                            </tr>
                            <button wire:click="back" class="btn-success  text-black font-bold py-1 px-4 rounded mb-2" style="position:absolute;top:20px;right:20px;padding: 10px 15px"><i class="fas fa-backward"></i></button>
                        </thead>
                        <tbody> 
                            @foreach($ProductTransaction as $index=>$producttransaction)
                        <tr class="text-center">
                            <td>{{$producttransaction->invoice_number}}</td>
                            <td>{{$producttransaction->product_id}}</td>
                            <td >{{$producttransaction->qty}}</td>
                            <td>{{$producttransaction->created_at}}</td>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="display:flex;justify-content:center">
                        {{$ProductTransaction->links()}}
                    </div>
                </div>       
            </div>
        </div>
        <div>
            