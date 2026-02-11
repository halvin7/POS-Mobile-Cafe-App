<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category as CategoryModel;

class Category extends Component
{


    public $id2,$category,$qty,$description;

    public function render()
    {
        $Category = CategoryModel::orderBy('created_at','DESC')->get();
        return view('livewire.category', [
            'Category' => $Category
        ]);
    }

    public function store(){
        $this->validate([
            'category' => 'required',
            'description' => 'required',
        ]);
    
        $Category = CategoryModel::find($this->id2);
        if($Category !=null){
            $Category-> Update([
            'category' => $this->category,
            'description' => $this->description]);
            session()->flash('message', 'Category Update Successfully');
            $this->id2='';
            
        }else{
            if(CategoryModel::where(
                'category','=',$this->category,'and',
                'description','=',$this->description
                )->count()<1
                ){
                    CategoryModel:: Create([
                        'category' => $this->category,
                        'description' => $this->description]);
                        session()->flash('message', 'Category Created Successfully');
                }else{
                    session()->flash('message', 'Category already exist');
                }
            }

        $this->category = '';
        $this->description = '';
    }
        
    public function edit($id){
        $Category = CategoryModel::findOrFail($id);
        $this->id2 = $id;
        $this->category = $Category->category;
        $this->description =$Category->description;
    }
        
    public function delete($id){
        $Category = CategoryModel::find($id);
        $Category->delete();
        session()->flash('message', 'Data Deleted Successfully');
        return redirect('/Category');
    }
        // $this->showModal();
    
    
    // public function edit($category)
    // {   
    //     $this->dispatchBrowserEvent('show-form');
    //     $this->state = $category->toArray();
    //     // dd($product);
    //     // return view('Editproduct', compact('product'));
    // }

    // public function update()
    // {
    //     dd('here');
    // }   
}