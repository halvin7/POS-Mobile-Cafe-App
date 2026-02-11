<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class Login extends Component
{
    public $form = [
        'email' => '',
        'password' => ''
    ];

    public function submit(){
        $this->validate([
            'form.email' => 'required|email',
            'form.password' => 'required'
        ]);

        $user = User::where([
            "email" => $this->form["email"]
        ])->get();
        $level = User::select('level')->where('email', $this->form["email"])->first();
        if(count($user) == 1 && Auth::attempt($this->form)){
            if ($level->level == 'admin'){
                redirect()->route('home');
            } else {
                redirect()->route('cart');
            }
            
        }else{
            session()->flash('error', 'Your credentials does not match. Please Try again later');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
