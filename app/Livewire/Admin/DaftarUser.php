<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class DaftarUser extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    public $no = 1;

    public $id;

    public $confirmHapus = false;

    public $selectedDateStart;
    public $selectedDateEnd;

    public function render()
    {
        $query = User::query();
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }
        if ($this->selectedDateStart) {
            $query->whereDate('created_at', '>=', $this->selectedDateStart);
        }
        if ($this->selectedDateEnd) {
            $query->whereDate('created_at', '<=', $this->selectedDateEnd);
        }

        $users = $query->orderBy('id', 'asc')->paginate(10);
        $totalUsers = $users->total();
        return view('livewire.admin.daftar-user', [
            'users' => $users,
            'totalUsers' => $totalUsers,
        ]);
    }

    public function UpdatingSearch()
    {
        $this->resetPage();
    }

    public function openModal($id)
    {
        $this->confirmHapus = true;
        $this->id = $id;
    }

    public function delete()
    {
        $id = $this->id;
        $user = User::find($id);
        $user->delete();
        $this->confirmHapus = false;
        $this->dispatch('pesanDelete');
    }

    public function cetakUser()
    {
        $query = User::query();

        if ($this->selectedDateStart) {
            $query->whereDate('created_at', '>=', $this->selectedDateStart);
        }
        if ($this->selectedDateEnd) {
            $query->whereDate('created_at', '<=', $this->selectedDateEnd);
        }
        // dd($this->selectedData);

        $users = $query->orderBy('id', 'desc')->get();
        $images = Storage::get("public/images/logoppid.jpg");
        $imagePath = base64_encode($images);
        $data = [
            'selectedDateStart' => $this->selectedDateStart,
            'selectedDateEnd' => $this->selectedDateEnd,
            'users' => $users,
            'imagePath' => $imagePath,
        ];
        // dd($data);

        $pdf = PDF::loadView('livewire.admin.laporan-daftar-user-pdf', compact('data'))
            ->setPaper('a4', 'landscape')
            ->setWarnings(false);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'laporan-daftar-user.pdf');
    }

    public function refresh()
    {
        $this->reset();
    }
}