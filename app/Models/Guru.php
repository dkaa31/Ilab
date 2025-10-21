<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nip', 'foto'];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function ruangans()
    {
        return $this->hasMany(Ruangan::class, 'penanggung_jawab_id');
    }
}
