<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\Perminfo;
use App\Charts\UserChart;
use App\Models\Pengkeber;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DashboardAdmin extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $perminfoCount;
    public $pengkeberCount;
    public $userCount;
    public $no = 1;

    public function mount()
    {
        $this->perminfoCount = Perminfo::count();
        $this->pengkeberCount = Pengkeber::count();
        $this->userCount = User::count();
        $users = User::all();
    }

    public function render()
    {
        return view('livewire.admin.dashboard-admin', [
            'users' => User::paginate(5)
        ]);
    }
}