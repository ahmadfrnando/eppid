<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Perminfo;
use App\Models\Pengkeber;

class DashboardUser extends Component
{
    public $perminfoCount;
    public $pengkeberCount;
    public $totalCount;

    public function mount()
    {
        $userId = auth()->user()->id; // Ambil user_id dari user yang sedang login
        $this->perminfoCount = Perminfo::where('user_id', $userId)->count();
        $this->pengkeberCount = Pengkeber::where('user_id', $userId)->count();
        $this->totalCount = $this->perminfoCount + $this->pengkeberCount;
    }

    public function render()
    {
        return view('livewire.user.dashboard-user');
    }
}