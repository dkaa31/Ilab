<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
    'hari', 'jam_ke', 'waktu_mulai', 'waktu_selesai',
    'guru_id', 'mapel_id', 'ruangan_id', 'status'
];

public function guru()
{
    return $this->belongsTo(Guru::class);
}

public function mapel()
{
    return $this->belongsTo(Mapel::class);
}

public function ruangan()
{
    return $this->belongsTo(Ruangan::class);
}
}
