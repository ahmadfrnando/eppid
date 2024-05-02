<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Perminfo;
use App\Models\Pengkeber;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanKeberatanForm extends Component
{
    public $user_id;
    public $noperminfos;
    public $nama;
    public $tujuan;
    public $alamat;
    public $pekerjaan;
    public $notel;
    public $alasan;
    public $kaspol;
    public $confirmTtd = false;
    public $signature;
    public $buktipengajuan = '';
    public $buktipath;
    public $nopengkeber;

    // public $perminfo;

    public $data = [];

    public function confirmTtdPengkeber()
    {
        $this->validate([
            'noperminfos' => 'required',
            // 'nama' => 'required',
            // 'tujuan' => 'required',
            // 'alamat' => 'required',
            // 'pekerjaan' => 'required',
            'notel' => 'required',
            'alasan' => 'required',
            'kaspol' => 'required',
        ], [
            'noperminfos.required' => 'No.pendaftaran permohonan harus diisi',
            // 'nama.required' => 'Nama harus diisi',
            // 'tujuan.required' => 'Tujuan Informasi harus diisi',
            // 'alamat.required' => 'Alamat harus diisi',
            // 'pekerjaan.required' => 'Pekerjaan harus diisi',
            'notel.required' => 'No. Telepon harus dipilih',
            'alasan.required' => 'Alasan harus dipilih',
            'kaspol.required' => 'Kasus polisi harus isi',
        ]);

        $this->confirmTtd = true;
    }

    public function kirim()
    {

        $this->validate([
            'signature' => 'required',
        ], [
            'signature.required' => 'Silahkan tanda tangan terlebih dahulu',
        ]);

        try {
            if ($this->signature) {
                $namaUser = Str::slug(Auth::user()->name);

                $namaFileTtd = 'signature-' . $namaUser . '-' . uniqid() . '.png';
                $signaturePath = 'signatures-pengajuan-keberatan/' . $namaFileTtd;
                Storage::disk('public')->put($signaturePath, base64_decode(Str::of($this->signature)->after(',')));

                $namaFileBukti = 'Bukti-pengajuan-keberatan-' . $this->nama . '-' . uniqid() . '.pdf';
                $buktiPath =  'Bukti-pengajuan-keberatan/' . $namaFileBukti;
                $selectedPerminfo = Perminfo::where('noperminfo', $this->noperminfos)->first();
                $data = [
                    'user_id' => Auth::id(),
                    'noperminfo' => $this->noperminfos,
                    'nopengkeber' => 'No.' . sprintf('%010d', mt_rand(1, 9999999999)),
                    'tujuan' => $selectedPerminfo->tujuan,
                    'nama' => $selectedPerminfo->nama,
                    'alamat' => $selectedPerminfo->alamat,
                    'pekerjaan' => $selectedPerminfo->pekerjaan,
                    'notel' => $this->notel,
                    'alasan' => $this->alasan,
                    'kaspol' => $this->kaspol,
                    'status' => 'PROSES',
                    'signature' => $signaturePath,
                    'buktipengajuan' => $buktiPath,
                    'pesan' => 'Silahkan menunggu informasi 14 hari setelah permohonan diterima',
                ];
                $pdf = Pdf::loadView('user.pengkeberpdf', $data, ['created_at' => now()]);
                Storage::disk('public')->put($buktiPath, $pdf->output());

                Pengkeber::create($data);
                $this->confirmTtd = false;

                $this->dispatch('terkirim');
                $this->reset();

                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->stream();
                }, $namaFileBukti);
            };
        } catch (\Exception $e) {
            $this->confirmTtd = false;
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            Log::error($e->getMessage());
        }
    }

    public function mount()
    {
        // $this->perminfo = Perminfo::where('user_id', auth()->id());
    }

    public function render()
    {
        $perminfo = Perminfo::where('user_id', auth()->id())->get();

        return view('livewire.user.pengajuan-keberatan-form', [
            'perminfo' => $perminfo,
        ]);
    }
}