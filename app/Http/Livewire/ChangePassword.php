<?php

namespace App\Http\Livewire;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'current_password'=>'required',
            'password' => 'required|min:6|different:current_password',
            'password_confirmation' => 'required|min:8|required_with:password|same:password'
        ]);
    }
    
    public function update_password()
    {
        // dd("Bla bla");
        $this->validate([
            'current_password'=>'required',
            'password' => 'required|min:6|confirmed|different:current_password',
            'password_confirmation' => 'required|min:6|required_with:password|same:password'

        ]);
        
        if(Hash::check($this->current_password,Auth::user()->password))
        {
            // dd("working");
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($this->password);
            // dd("before save" + $user);
            $user->save();
            session()->flash('successful','Password has been changed successfully!');
            return redirect(request()->header('Referer'));
        }
        else
        {
            // dd("Not working");
            session()->flash('error_password','Password Error!, Ensure to enter correct details');
            return redirect(request()->header('Referer'));

        }
    }

    public function render()
    {
        return view('livewire.change-password');
    }
}
