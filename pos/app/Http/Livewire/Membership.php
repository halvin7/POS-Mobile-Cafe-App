<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Membership as MembershipModel;
use Illuminate\Support\Facades\Storage;

class Membership extends Component
{
    use WithFileUploads;

    public $id2,$image,$name,$ponsel,$address,$point;

    public function render()
    {
        $membership = MembershipModel::orderBy('created_at','DESC')->get();
        return view('livewire.membership', [
            'membership' => $membership
        ]);
    }

    public function previewImage(){
        $this->validate([
            'image' => 'image|max:2048'
        ]);
    }

    public function store(){
        $this->validate([
            'image' => 'image|max:2048|required',
            'name' => 'required',
            'ponsel' => 'required',
            'address' => 'required',
            'point' => 'required',
        ]);
    
    $imageName = md5($this->image.microtime().'.'.$this->image->extension());

        Storage::putFileAs(
            'public/images',
            $this->image,
            $imageName
        );
        $membership = MembershipModel::find($this->id2);
        if($membership !=null){
            $membership-> Update([
            'image' => $imageName,
            'name' => $this->name,
            'ponsel' => $this->ponsel,
            'address' => $this->address,
            'point' => $this->point]);
            session()->flash('message', 'Members Update Successfully');
            $this->id2='';
            
        }else{
            if(MembershipModel::where(
                'name','=',$this->name,'and',
                'ponsel','=',$this->ponsel,'and',
                'address','=',$this->address,
                )->count()<1
                ){
                    MembershipModel:: Create([
                        'image' =>$imageName,
                        'name' => $this->name,
                        'ponsel' => $this->ponsel,
                        'address' => $this->address,
                        'point' => $this->point]);
                        session()->flash('message', 'Membership Created Successfully');
                }else{
                    session()->flash('message', 'Membership already exist');
                }
            }
        $this->image = '';
        $this->name = '';
        $this->ponsel = '';
        $this->address = '';
        $this->point = '';
    }

    public function edit($id){
        $membership = MembershipModel::findOrFail($id);
        $this->id2 = $id;
        $this->name = $membership->name;
        $this->ponsel = $membership->ponsel;
        $this->address = $membership->address;
        $this->point = $membership->point;
    }
    
    public function delete2($id){
        $membership = MembershipModel::find($id);
        $membership->delete();
        session()->flash('message', 'Data Deleted Successfully');
        return redirect('/Membership');
    }
}