<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Membership Data</h2>
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
                                <th width="20%">KTP</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Point</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($membership as $index=>$membership)
                        <tr class="text-center">
                            <td>{{$index + 1}}</td>
                            <td><img src="{{ asset('storage/images/'.$membership->image)}}" alt="membership image" class="img-fluid"></td>
                            <td>{{$membership->name}}</td>
                            <td>{{$membership->ponsel}}</td>
                            <td>{{$membership->address}}</td>
                            <td>{{$membership->point}}</td>
                            <td>
                            <button id='productedit' wire:click="edit({{ $membership->id }})" class="btn-success btn-block text-black font-bold py-1 px-4 rounded mb-2"><i class="fas fa-edit"></i></button>
                            <button  class="btn-danger delete2 btn-block text-black font-bold py-1 px-4 rounded mb-2" data-id="{{ $membership->id }}" data-name="{{ $membership->name }}"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>       
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Form Data</h2>
                    <form wire:submit.prevent="store">
                        <div Class="form-group">
                            <label>Full Name</label>
                            <input wire:model="name" type="text" class="form-control" placeholder="Enter Full Name">
                            @error('name') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div Class="form-group">
                            <label>KTP</label>
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
                            <label>Phone Number</label>
                            <input wire:model="ponsel" type="number" class="form-control" placeholder="Enter Phone Number">
                            @error('ponsel') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div Class="form-group">
                            <label>Address</label>
                            <input wire:model="address" type="text" class="form-control" placeholder="Enter Address">
                            @error('address') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div Class="form-group">
                            <label>Point</label>
                            <input wire:model="point" type="number" class="form-control" placeholder="Enter Point">
                            @error('point') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-primary btn-block">Submit Membership</button>
                        </div>
                    </form>
                </div>       
            </div>
        </div>
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-3.6.0.slim.js"
    integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
    crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    $('.delete2').click( function(){
        var name = $(this).attr('data-name');
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You will delete data "+name+" ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/delete2/"+id+" "
                swal("Data deleted successfully", {
                icon: "success",
                });
            } else {
                swal("Your data is safe!");
            }
        });
    })
        
</script>