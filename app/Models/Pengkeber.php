<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengkeber extends Model
{   
    protected $table = 'pengkeber';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'noperminfo',
        'nopengkeber',
        'nama',
        'alamat',
        'pekerjaan',
        'tujuan',
        'notel',
        'alasan',
        'kaspol',
        'status',
        'signature',
        'buktipengajuan',
        'pesan',
        'doc',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function perminfo()
    {
        return $this->belongsTo(Perminfo::class, 'noperminfo', 'noperminfo');
    }
}