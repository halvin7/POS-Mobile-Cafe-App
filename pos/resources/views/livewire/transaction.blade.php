<div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Payment History</h2><button wire:click="next" class="btn-success text-black font-bold py-1 px-4 rounded mb-2" style="position:absolute;top:20px;right:20px;padding: 10px 15px"><i class="fas fa-forward"></i></button>
                    <table class="table table-bordered table-hovered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Invoice Number</th>
                                <th>User ID</th>
                                <th>Pay</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            
                        </thead>
                        <tbody> 
                            @foreach($Transaction as $index=>$transaction)
                        <tr class="text-center">
                            <td>{{$transaction->invoice_number}}</td>
                            <td>{{$transaction->user_id}}</td>
                            <td> Rp {{ number_format($transaction['pay'],2,',','.') }} </td>
                            <td> Rp {{ number_format($transaction['total'],2,',','.') }} </td>
                            <td>{{$transaction->created_at}}</td>
                            <td><a href="{{route('invoice_param',$transaction->invoice_number)}}" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></a></td>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="display:flex;justify-content:center">
                        {{$Transaction->links()}}
                    </div>
                </div>       
            </div>
        </div>
    </div>
</div>
