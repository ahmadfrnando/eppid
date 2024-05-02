<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pengkeber;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PengkeberAdmin extends Component
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
        $query = Pengkeber::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('id', 'like', '%' . $this->search . '%')
                    ->orWhere('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('alasan', 'like', '%' . $this->search . '%')
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

        $pengkebers = $query->orderBy('id', 'desc')->paginate(10);
        $totalPengkebers = $pengkebers->total();
        return view('livewire.admin.pengkeber-admin', [
            'pengkebers' => $pengkebers,
            'totalPengkebers' => $totalPengkebers,
        ]);
    }

    public function UpdatingSearch()
    {
        $this->resetPage();
    }

    public function openModal($id)
    {
        $this->statusChange = true;
        $this->id = $id;
        $pengkeber = Pengkeber::find($this->id);
        $this->pesan = $pengkeber->pesan;
        $this->status = $pengkeber->status;
    }

    public function update()
    {
        $pengkeber = Pengkeber::find($this->id);

        $pengkeber->update([
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
        $pengkeber = Pengkeber::find($this->id);
    }

    public function updateDoc()
    {
        $this->validate([
            'doc' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'doc.required' => 'Berkas harus diunggah',
        ]);

        $pengkeber = Pengkeber::find($this->id);
        $namaUser = Str::slug($pengkeber->nama);
        $namaFile = 'Dokumen-pengajuan-keberatan' . $namaUser . '-' . uniqid() . '.' . $this->doc->getClientOriginalExtension();
        $docPath = $this->doc->storeAs('admin/dokumen-pengajuan-keberatan', $namaFile, 'public');

        if ($this->doc) {
            $pengkeber->update([
                'doc' => $docPath,
            ]);
        }

        $this->reset();
        $this->modalDoc = false;
    }

    public function cetakPengkeber()
    {
        $query = Pengkeber::query();

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

        $pengkebers = $query->orderBy('id', 'desc')->get();
        $images = Storage::get("public/images/logoppid.jpg");
        $imagePath = base64_encode($images);
        $data = [
            'selectedData' => $this->selectedData,
            'selectedDateStart' => $this->selectedDateStart,
            'selectedDateEnd' => $this->selectedDateEnd,
            'pengkebers' => $pengkebers,
            'imagePath' => $imagePath,
        ];
        // dd($data);

        $pdf = PDF::loadView('livewire.admin.laporan-data-pengkeber-pdf', compact('data'))
            ->setPaper('a4', 'landscape')
            ->setWarnings(false);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'laporan-pengajuan-keberatan.pdf');
    }

    public function refresh()
    {
        $this->reset();
    }
}