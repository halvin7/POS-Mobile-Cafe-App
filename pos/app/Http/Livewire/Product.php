<?php

namespace App\Http\Livewire;

use DB;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Storage;

use Livewire\WithPagination;

class Product extends Component
{
    use WithFileUploads;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id2, $name, $category, $image, $description, $qty, $price;
    public $Jenis;

    public function render()
    {
        $Jenis = DB::table('category')->get();

        $products = ProductModel::orderBy('created_at', 'DESC')->paginate(5);
        foreach ($products as $product) {
            $product->image_url = asset('storage/images/' . $product->image);
        }
        return view('livewire.product', [
            'products' => $products,
            'jenis' => $Jenis,
        ]);
    }


    // public function showModal() {
    //     $this->isOpen = true;
    // }

    // public function hideModal() {
    //     $this->isOpen = false;
    // }

    public function previewImage()
    {
        $this->validate([
            'image' => 'image|max:2048'
        ]);
    }

    public function store()
    {
        $this->validate(
            [
                'name' => 'required',
                'category' => 'required',
                'image' => 'image|max:2048|required',
                'description' => 'required',
                'qty' => 'required',
                'price' => 'required',
            ]
        );

        $imageName = $this->image->hashName();
        $this->image->storeAs('images', $imageName, 'public');
        // Storage::putFileAs(
        //     'public/images',
        //     $this->image,
        //     $imageName
        // );

        // Check if an existing product is being updated
        $product = ProductModel::find($this->id2);

        if ($product) {
            // Update product
            $product->update([
                'name' => $this->name,
                'category' => $this->category,
                'image' => $imageName,
                'description' => $this->description,
                'qty' => $this->qty,
                'price' => $this->price
            ]);

            session()->flash('message', 'Product updated successfully.');
            $this->id2 = ''; // Reset for the next operation
        } else {
            // Create new product
            ProductModel::create([
                'name' => $this->name,
                'category' => $this->category,
                'image' => $imageName,
                'description' => $this->description,
                'qty' => $this->qty,
                'price' => $this->price
            ]);

            session()->flash('message', 'Product created successfully.');
        }

        // Reset form inputs
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->id2 = null;
        $this->name = '';
        $this->category = '';
        $this->image = '';
        $this->description = '';
        $this->qty = '';
        $this->price = '';
    }


    //     $product = ProductModel::find($this->id2);
    //     if ($product != null) {
    //         $product->Update([
    //             'name' => $this->name,
    //             'category' => $this->category,
    //             'image' => $imageName,
    //             'description' => $this->description,
    //             'qty' => $this->qty,
    //             'price' => $this->price
    //         ]);
    //         session()->flash('message', 'Product Update Successfully');
    //         $this->id2 = '';
    //     } else {
    //         if (
    //             ProductModel::where(
    //                 'name',
    //                 '=',
    //                 $this->name,
    //                 'and',
    //                 'category',
    //                 '=',
    //                 $this->category,
    //                 'and',
    //                 'image',
    //                 '=',
    //                 $imageName,
    //                 'and',
    //                 'description',
    //                 '=',
    //                 $this->description,
    //                 'and',
    //                 'qty',
    //                 '=',
    //                 $this->qty,
    //                 'and',
    //                 'price',
    //                 '=',
    //                 $this->price
    //             )->count() < 1
    //         ) {
    //             ProductModel::Create([
    //                 'name' => $this->name,
    //                 'category' => $this->category,
    //                 'image' => $imageName,
    //                 'description' => $this->description,
    //                 'qty' => $this->qty,
    //                 'price' => $this->price
    //             ]);
    //             session()->flash('message', 'Product Created Successfully');
    //         } else {
    //             session()->flash('message', 'Product already exist');
    //         }
    //     }
    //     // ProductModel::UpdateOrCreate([
    //     //     'name' => $this->name,
    //     //     'category' => $this->category,
    //     //     'image' => $imageName,
    //     //     'description' => $this->description,
    //     //     'qty' => $this->qty,
    //     //     'price' => $this->price
    //     // session()->flash('info', 'Product Created Successfully');
    //     $this->name = '';
    //     $this->category = '';
    //     $this->image = '';
    //     $this->description = '';
    //     $this->qty = '';
    //     $this->price = '';
    // }

    public function edit($id)
    {
        $product = ProductModel::findOrFail($id);
        $this->id2 = $id;
        $this->name = $product->name;
        $this->category = $product->category;
        $this->description = $product->description;
        $this->qty = $product->qty;
        $this->price = $product->price;

        // $this->showModal();
    }

    public function delete1($id)
    {
        $product = ProductModel::find($id);
        $product->delete();
        session()->flash('message', 'Data Deleted Successfully');
        return redirect('/products');
    }

    // public function edit($id)
    // {   
    //     $product = ProductModel::find($id);
    //     return redirect('/Editproduct');
    // }

    // public function edit(ProductModel $product)
    // {   
    //     $this->dispatchBrowserEvent('show-form');
    //     $this->state = $product->toArray();
    //     // dd($product);
    //     // return view('Editproduct', compact('product'));
    // }

    // public function update()
    // {
    //     dd('here');
    // }   
}
