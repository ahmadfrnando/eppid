<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Carbon;

class UserChart extends Component
{
    public $userData;
    public $data;

    public function mount()
    {
        $year = Carbon::now()->year;
        
        $data = [
                'Januari' => User::whereYear('created_at', $year)->whereMonth('created_at', 1)->count(),
                'Februari' => User::whereYear('created_at', $year)->whereMonth('created_at', 2)->count(),
                'Maret' => User::whereYear('created_at', $year)->whereMonth('created_at', 3)->count(),
                'April' => User::whereYear('created_at', $year)->whereMonth('created_at', 4)->count(),
                'Mei' => User::whereYear('created_at', $year)->whereMonth('created_at', 5)->count(),
                'Juni' => User::whereYear('created_at', $year)->whereMonth('created_at', 6)->count(),
                'Juli' => User::whereYear('created_at', $year)->whereMonth('created_at', 7)->count(),
                'Agustus' => User::whereYear('created_at', $year)->whereMonth('created_at', 8)->count(),
                'September' => User::whereYear('created_at', $year)->whereMonth('created_at', 9)->count(),
                'Oktober' => User::whereYear('created_at', $year)->whereMonth('created_at', 10)->count(),
                'November' => User::whereYear('created_at', $year)->whereMonth('created_at', 11)->count(),
                'Desember' => User::whereYear('created_at', $year)->whereMonth('created_at', 12)->count(),
                'year' => $year,
        ];
        
        $this->userData = json_encode($data);
    }

    public function render()
    {
        return view('livewire.admin.user-chart');
    }
}