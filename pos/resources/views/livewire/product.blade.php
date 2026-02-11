<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Product List</h2>
                    <div>
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    <table class="table table-bordered table-hovered table-striped"> 
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th width="20%">Image</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $index=>$product)
                        <tr class="text-center">
                            <td>{{$index + 1}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->category}}</td>
                            <td>
                                <img src="{{ asset('storage/images/' . $product->image) }}" alt="product image" class="img-fluid">

                                {{-- <p>Image URL: {{ asset('storage/images/' . $product->image) }}</p> --}}
                                
                                
                                {{-- <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100px; height: auto;"> --}}

                             </td>
                            {{-- <td><img src="{{ url('storage/app/public/images/'.$product->image)}}" alt="product image" class="img-fluid"></td> --}}
                            <td>{{$product->description}}</td>
                            <td>{{$product->qty}}</td>  
                            <td> Rp{{ number_format($product['price'],2,',','.') }} </td>
                            <td>
                            <button id='productedit' wire:click="edit({{ $product->id }})" class="btn-success btn-blocktext-black font-bold py-1 px-4 rounded mb-2"><i class="fas fa-edit"></i></button>
                            <button  class="btn-danger delete1 btn-block text-black font-bold py-1 px-4 rounded mb-2" data-name="{{ $product->name }}" data-id="{{ $product->id }}"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="display:flex;justify-content:center">
                        {{$products->links()}}
                    </div>
                </div>       
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 id='producttitle' class="font-weight-bold mb-3">Form Product</h2>
                    <form wire:submit.prevent="store">
                        <div Class="form-group">
                        <input type="hidden" wire:model="id2">   
                        <label>Product Name</label>
                            <input wire:model="name" type="text" class="form-control" placeholder="Enter Product Name">
                            @error('name') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div Class="form-group">
                        <label>Category</label> 
                        <div>
                            <select wire:model="category" class="form-control mb-2">
                                <option hidden></option>
                                @foreach ($jenis as $items)
                                <option value="{{$items->category}}">{{$items->category}}</option>
                                @endforeach
                            </select>
                            @error('category') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div Class="form-group">
                            <label>Image</label>
                            <div class="custom-file">
                                <input wire:model="image" type="file" class="custom-file-input" id="customeFile">
                                <label for="customFile" class='custom-file-label'>Choose Image</label>
                                @error('image') <small class="text-danger">{{$message}}</small>@enderror
                            </div> 
                            @if($image)
                                <label class="mt-2">Image Preview</label>
                                <img src="{{$image->temporaryUrl()}}" class="img-fluid" alt="Preview Image">
                            @endif 
                        </div>
                        <div Class="form-group">
                            <label>Description</label>
                            <textarea wire:model="description"  class="form-control" placeholder="Enter Description"></textarea>
                            @error('description') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div Class="form-group">
                            <label>Quantity</label>
                            <input wire:model="qty" type="number" class="form-control" placeholder="Enter Quantity">
                            @error('qty') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div Class="form-group">
                            <label>Price</label>
                            <input wire:model="price" type="number" class="form-control" placeholder="Enter Price">
                            @error('price') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-primary btn-block">Submit Product</button>
                        </div>
                    </form>
                </div>       
            </div>
        </div>

        <!-- Modal
        <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <form wire:submit.prevent="update">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter Product Name">
                                @error('name') <small class="text-danger">{{$message}}</small>@enderror
                            </div>
                            <div Class="form-group">
                                <label>Category</label>
                                <select>
                                    <option hidden></option>
                                    <option value="Snack">Snack</option>
                                    <option value="Coffe">Coffe</option>
                                    <option value="mercedes">Beverages</option>
                                </select>
                                @error('category') <small class="text-danger">{{$message}}</small>@enderror
                            </div>
                            <div Class="form-group">
                                <label>Image</label>
                                <div class="custom-file">
                                    <input wire:model="image" type="file" class="custom-file-input" id="customeFile">
                                    <label for="customFile" class='custom-file-label'>Choose Image</label>
                                    @error('image') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                @if($image)
                                <label class="mt-2">Image Preview</label>
                                <img src="{{$image->temporaryUrl()}}" class="img-fluid" alt="Preview Image">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" aria-describedby="descriptionHelp" placeholder="Enter Description">
                                @error('description') <small class="text-danger">{{$message}}</small>@enderror
                            </div>
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="integer" class="form-control" id="qty" aria-describedby="qtyHelp" placeholder="Enter Quantity">
                                @error('qty') <small class="text-danger">{{$message}}</small>@enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="integer" class="form-control" id="price" aria-describedby="priceHelp" placeholder="Enter Price">
                                @error('price') <small class="text-danger">{{$message}}</small>@enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-danger btn-blocktext-black font-bold py-1 px-3 rounded mb-2" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel </button>
                        <button type="submit" class="btn-success btn-blocktext-black font-bold py-1 px-3 rounded mb-2"><i class="fa fa-save mr-1"></i> Save </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>

<script>
$("#productedit").click(function(e){
    e.preventDefault()
    $("#producttitle").text("Edit Product");
    })
</script> -->
<script
    src="https://code.jquery.com/jquery-3.6.0.slim.js"
    integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
    crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    $('.delete1').click( function(){
        var name = $(this).attr('data-name');
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You will delete Product "+name+" ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/delete1/"+id+" "
                swal("Data deleted successfully", {
                icon: "success",
                });
            } else {
                swal("Your data is safe!");
            }
        });
    })
        
</script>