<?php

namespace App\Livewire;

use App\Models\Admin;
use Livewire\Component;

class NavigationMenuAdmin extends Component
{   
    public $name;
    public $email;

    public function mount()
    {
        $admin = Admin::find(auth()->id()); // Sesuaikan dengan struktur tabel admin Anda
        $this->name = $admin->name ?? '';
    }
    
    public function render()
    {   
        return view('navigation-menu-admin' , [
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }
}