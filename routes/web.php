<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SignaturePadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware([
    'auth:sanctum,admin', 'verified'
])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
})->group(function () {
    Route::get('admin/permohonan-informasi', function () {
        return view('admin.perminfo-admin');
    })->name('admin.permohonan-informasi');
})->group(function () {
    Route::get('admin/pengajuan-keberatan', function () {
        return view('admin.pengkeber-admin');
    })->name('admin.pengajuan-keberatan');
})->group(function () {
    Route::get('admin/daftar-user', function () {
        return view('admin.daftar-user');
    })->name('admin.daftaruser');
})->group(function () {
    Route::get('admin/change-password', function () {
        return view('admin.change-password');
    })->name('admin.change-password');
});



Route::post('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
})->group(function () {
    Route::get('/permohonan-informasi', function () {
        return view('user.permohonan-informasi');
    })->name('user.permohonan-informasi');
})->group(function () {
    Route::get('/pengajuan-keberatan', function () {
        return view('user.pengajuan-keberatan');
    })->name('user.pengajuan-keberatan');
})->group(function () {
    Route::get('/riwayat', function () {
        return view('user.riwayat');
    })->name('user.riwayat');
});