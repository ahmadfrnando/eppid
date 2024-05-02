<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Perminfo;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;


class RiwayatPerminfo extends Component
{   
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    public $no = 1;
    
    public function render()
    {   
        $userId = auth()->user()->id;
        return view('livewire.user.riwayat-perminfo', [
            'perminfos' => Perminfo::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                      ->orWhere('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('informasidimohon', 'like', '%' . $this->search . '%')
                      ->orWhere('noperminfo', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10),
        ]);
    }

    public function UpdatingSearch()
    {
        $this->resetPage();
    }
}