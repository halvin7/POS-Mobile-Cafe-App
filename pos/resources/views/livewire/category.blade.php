<div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Category List</h2>
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
                                <th>Category</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($Category as $index=>$category)
                        <tr class="text-center">
                            <td>{{$index+1}}</td>
                            <td>{{$category->category}}</td>
                            <td>{{$category->description}}</td>
                            <td>
                            <button id='productedit' wire:click="edit({{ $category->id }})" class="btn-success btn-block text-black font-bold py-1 px-4 rounded mb-2"><i class="fas fa-edit"></i></button>
                            <button  class="btn-danger delete btn-block text-black font-bold py-1 px-4 rounded mb-2" data-category="{{ $category->category }}" data-id="{{ $category->id }}"><i class="fas fa-trash"></i></button>
                            <!-- wire:click="delete({{ $category['id']}})" -->
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
                    <h2 class="font-weight-bold mb-3">Form Category</h2>
                    <form wire:submit.prevent="store">
                        <div Class="form-group">
                        <input type="hidden" wire:model="id2">
                            <label>Category Name</label>
                            <input wire:model="category" type="text" class="form-control" placeholder="Enter Category Name">
                            @error('category') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div Class="form-group">
                            <label>Description</label>
                            <input wire:model="description" type="text" class="form-control" placeholder="Enter Description">
                            @error('description') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-primary btn-block">Submit Category</button>
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
    $('.delete').click( function(){
        var category = $(this).attr('data-category');
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You will delete Category "+category+" ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/delete/"+id+" "
                swal("Data deleted successfully", {
                icon: "success",
                });
            } else {
                swal("Your data is safe!");
            }
        });
    })
        
</script>