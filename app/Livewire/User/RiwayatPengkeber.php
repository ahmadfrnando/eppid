<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Pengkeber;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;


class RiwayatPengkeber extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    public $no = 1;

    public $pesan;

    public function render()
    {
        $userId = auth()->user()->id;
        return view('livewire.user.riwayat-pengkeber', [
            'pengkebers' => Pengkeber::where('user_id', $userId)
                ->where(function ($query) {
                    $query->where('id', 'like', '%' . $this->search . '%')
                        ->orWhere('nama', 'like', '%' . $this->search . '%')
                        ->orWhere('noperminfo', 'like', '%' . $this->search . '%')
                        ->orWhere('alasan', 'like', '%' . $this->search . '%');
                })
                ->orderBy('id', 'desc')
                ->paginate(10),
        ]);
    }

    public function UpdatingSearch()
    {
        $this->resetPage();
    }

    public function pesan($pesan)
    {
        $pesan = new $this->pesan;
        dd($pesan);
        // $this->dispatch('showPesan', ['pesan' => $pesan]);
        $this->resetPage();
    }
}