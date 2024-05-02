<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Perminfo;
use App\Models\Pengkeber;

class PerminfoChart extends Component
{
    public $perminfo;
    public $jenisData;
    public function render()
    {
        $year = Carbon::now()->year;
        
        $perminfo1 = Perminfo::where('data', 'Data Perkara')->count();
        $perminfo2 = Perminfo::where('data', 'Data Kepegawaian')->count();
        $perminfo3 = Perminfo::where('data', 'Data Aset/keuangan')->count();
        $perminfo4 = Perminfo::where('data', 'Data Umum/lainnya')->count();
        
        $pengkeber1 = Pengkeber::where('data', 'Data Perkara')->count();
        $pengkeber2 = Pengkeber::where('data', 'Data Kepegawaian')->count();
        $pengkeber3 = Pengkeber::where('data', 'Data Aset/keuangan')->count();
        $pengkeber4 = Pengkeber::where('data', 'Data Umum/lainnya')->count();

        $dataPerminfo = [$perminfo1, $perminfo2, $perminfo3, $perminfo4];
        $dataPengkeber = [$pengkeber1, $pengkeber2, $pengkeber3, $pengkeber4];

        $data = ['perminfo' => $dataPerminfo, 
                'pengkeber' => $dataPengkeber,
                'year' => $year,
            ];

        $this->jenisData = json_encode($data);
        return view('livewire.admin.perminfo-chart');
    }
}