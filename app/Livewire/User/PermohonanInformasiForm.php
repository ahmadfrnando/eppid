<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Perminfo;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PermohonanInformasiForm extends Component
{
    use WithFileUploads;

    public $confirmTtd = false;

    public $berkas;
    public $user_id;
    public $nama;
    public $alamat;
    public $pekerjaan;
    public $informasidimohon;
    public $tujuan;
    public $data;
    public $jenis;
    public $caramemperoleh;
    public $caramendapatkan;
    public $jenisberkas;
    public $signature;
    public $buktipengajuan = '';
    public $forms = [];
    public $noperminfo;

    public $pdf;

    public function render()
    {
        return view('livewire.user.permohonan-informasi-form');
    }

    public function confirmTtdPerminfo()
    {
        $this->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'informasidimohon' => 'required',
            'tujuan' => 'required',
            'data' => 'required',
            'jenis' => 'required',
            'caramemperoleh' => 'required',
            'caramendapatkan' => 'required',
            'jenisberkas' => 'required',
            'berkas' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'pekerjaan.required' => 'Pekerjaan harus diisi',
            'informasidimohon.required' => 'Informasi yang dimohon harus diisi',
            'tujuan.required' => 'Tujuan Informasi harus diisi',
            'data.required' => 'Jenis data harus dipilih',
            'jenis.required' => 'Jenis informasi harus dipilih',
            'caramemperoleh.required' => 'Cara memperoleh informasi harus dipilih',
            'caramendapatkan.required' => 'Cara mendapatkan harus dipilih',
            'jenisberkas.required' => 'Upload berkas harus dipilih',
            'berkas.required' => 'Berkas harus diunggah',
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
            if ($this->berkas && $this->signature) {
                // $namaUser = Str::slug(Auth::user()->name);
                // $namaFile = $namaUser . '-' . Str::slug($this->jenisberkas) . '-' . uniqid() . '.' . $this->berkas->getClientOriginalExtension();
                // $berkasPath = $this->berkas->storeAs('berkas-permohonan-informasi', $namaFile, 'public');

                // $namaFileTtd = 'signature-' . $namaUser . '-' . uniqid() . '.png';
                // $signaturePath = 'signatures-permohonan-informasi/' . $namaFileTtd;
                // Storage::disk('public')->put($signaturePath, base64_decode(Str::of($this->signature)->after(',')));
                // $namaFileBukti = 'Bukti-permohonan-informasi-' . $this->noperminfo . '-' . uniqid() . '.pdf';
                // $buktiPath =  'Bukti-permohonan-informasi/' . $namaFileBukti;

                $namaUser = Str::slug(Auth::user()->name);
                $namaFile = $namaUser . '-' . Str::slug($this->jenisberkas) . '-' . uniqid() . '.' . $this->berkas->getClientOriginalExtension();
                $berkasPath = $this->berkas->storeAs('berkas-permohonan-informasi', $namaFile, 'public');

                $namaFileTtd = 'signature' . uniqid() . '.png';
                $signaturePath = 'signatures-permohonan-informasi/' . $namaFileTtd;
                Storage::disk('public')->put($signaturePath, base64_decode(Str::of($this->signature)->after(',')));
                
                $namaFileBukti = 'Bukti-permohonan-informasi-' . uniqid() . '.pdf';
                $buktiPath =  'Bukti-permohonan-informasi/' . $namaFileBukti;

                $forms = [
                    'user_id' => Auth::id(),
                    'nama' => $this->nama,
                    'noperminfo' => 'No.' . sprintf('%010d', mt_rand(1, 9999999999)),
                    'alamat' => $this->alamat,
                    'pekerjaan' => $this->pekerjaan,
                    'informasidimohon' => $this->informasidimohon,
                    'tujuan' => $this->tujuan,
                    'data' => $this->data,
                    'jenis' => $this->jenis,
                    'caramemperoleh' => $this->caramemperoleh,
                    'caramendapatkan' => $this->caramendapatkan,
                    'jenisberkas' => $this->jenisberkas,
                    'status' => 'PROSES',
                    'berkas' => $berkasPath,
                    'signature' => $signaturePath,
                    'buktipengajuan' => $buktiPath,
                    'pesan' => 'Silahkan menunggu informasi 14 hari setelah permohonan diterima',
                ];

                $pdf = Pdf::loadView('user.perminfopdf', $forms, ['created_at' => now()]);
                Storage::disk('public')->put($buktiPath, $pdf->output());

                Perminfo::create($forms, ['buktipengajuan' => $buktiPath]);


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
}