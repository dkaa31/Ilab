<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelase extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'wali_kelas_id'];

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }

    public function jadwals()
    {
        return $this->hasMany(jadwal::class);
    }
}
