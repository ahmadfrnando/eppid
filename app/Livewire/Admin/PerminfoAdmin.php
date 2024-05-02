<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Models\Perminfo;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PerminfoAdmin extends Component
{
    use WithPagination, WithoutUrlPagination;
    use WithFileUploads;

    public $search = '';

    public $no = 1;

    public $newStatus;
    public $newPesan;

    public $statusChange = false;
    public $modalDoc = false;

    public $id;
    public $status;
    public $pesan;
    public $ketikPesan;
    public $pesanOto;
    public $doc;
    public $selectedData;
    public $selectedDateStart;
    public $selectedDateEnd;

    public function render()
    {
        $query = Perminfo::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('informasidimohon', 'like', '%' . $this->search . '%')
                    ->orWhere('noperminfo', 'like', '%' . $this->search . '%')
                    ->orWhere('data', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedData !== "null" && $this->selectedData !== null) {
            $query->where('data', $this->selectedData);
        }

        if ($this->selectedDateStart) {
            $query->whereDate('created_at', '>=', $this->selectedDateStart);
        }
        if ($this->selectedDateEnd) {
            $query->whereDate('created_at', '<=', $this->selectedDateEnd);
        }

        $perminfos = $query->orderBy('id', 'desc')->paginate(10);
        $totalPerminfos = $perminfos->total();

        return view('livewire.admin.perminfo-admin', [
            'perminfos' => $perminfos,
            'totalPerminfos' => $totalPerminfos,
        ]);
    }

    public function refresh()
    {
        $this->reset();
    }

    public function filter()
    {
        $this->dispatch($this->perminfos, $this->query);
    }

    public function UpdatingSearch()
    {
        $this->resetPage();
    }

    public function openModal($id)
    {
        $this->statusChange = true;
        $this->id = $id;
        $perminfo = Perminfo::find($this->id);
        $this->pesan = $perminfo->pesan;
        $this->status = $perminfo->status;
    }

    public function update()
    {
        $perminfo = Perminfo::find($this->id);

        $perminfo->update([
            'status' => $this->status,
            'pesan' => $this->pesan,
        ]);


        $this->reset();
        $this->statusChange = false;
    }

    public function openModalDoc($id)
    {
        $this->modalDoc = true;
        $this->id = $id;
        $perminfo = Perminfo::find($this->id);
    }

    public function updateDoc()
    {
        $this->validate([
            'doc' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'doc.required' => 'Berkas harus diunggah',
        ]);

        $perminfo = Perminfo::find($this->id);
        $namaUser = Str::slug($perminfo->nama);
        $namaFile = 'Dokumen-permohonan-informasi-' . $namaUser . '-' . uniqid() . '.' . $this->doc->getClientOriginalExtension();
        $docPath = $this->doc->storeAs('admin/dokumen-permohonan-informasi', $namaFile, 'public');

        if ($this->doc) {
            $perminfo->update([
                'doc' => $docPath,
            ]);
        }

        $this->reset();
        $this->modalDoc = false;
    }

    public function cetakPerminfo()
    {
        $query = Perminfo::query();

        if ($this->selectedData) {
            $query->where('data', $this->selectedData);
        }

        if ($this->selectedDateStart) {
            $query->whereDate('created_at', '>=', $this->selectedDateStart);
        }
        if ($this->selectedDateEnd) {
            $query->whereDate('created_at', '<=', $this->selectedDateEnd);
        }
        // dd($this->selectedData);

        $perminfos = $query->orderBy('id', 'asc')->get();
        $images = Storage::get("public/images/logoppid.jpg");
        $imagePath = base64_encode($images);
        $data = [
            'selectedData' => $this->selectedData,
            'selectedDateStart' => $this->selectedDateStart,
            'selectedDateEnd' => $this->selectedDateEnd,
            'perminfos' => $perminfos,
            'imagePath' => $imagePath,
        ];
        // dd($data);

        $pdf = PDF::loadView('livewire.admin.laporan-data-perminfo-pdf', compact('data'))
            ->setPaper('a4', 'landscape')
            ->setWarnings(false);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'laporan-permohonan-informasi.pdf');
    }
}