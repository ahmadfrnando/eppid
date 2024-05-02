<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{   
    public $admin;
    public $current_password;
    public $password;
    public $password_confirmation;
    
    
   public function updatePassword()
   {
       // Get the authenticated user
       $admin = Admin::find(auth()->id());;

       // Validate the request data
       $validatedData = $this->validate([
    'current_password' => 'required',
    'password' => 'required|min:8|confirmed|same:password_confirmation',
    'password_confirmation' => 'required',
]);

       // Check if the current password matches the user's password
       if (!Hash::check($validatedData['current_password'], $admin->password)) {
           // Return an error message if the current password is incorrect
           $this->dispatch('current_password_incorrect');
        //    session()->flash('error', 'Current password is incorrect.');
           $this->reset();
           return;
        }
        
        // Update the user's password
        $admin->password = Hash::make($validatedData['password']);
        $admin->save();
        
        // Return a success message
        $this->dispatch('updated');
        $this->reset();
   }

    
    public function render()
    {
        return view('livewire.admin.change-password');
    }

}