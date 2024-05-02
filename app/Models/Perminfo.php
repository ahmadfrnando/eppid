<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perminfo extends Model
{
    protected $table = 'perminfo';
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public static function getDataById($id)
    {
        return self::find($id);
    }
    public function pengkebers()
    {
        return $this->hasMany(Pengkeber::class, 'noperminfo', 'noperminfo');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}