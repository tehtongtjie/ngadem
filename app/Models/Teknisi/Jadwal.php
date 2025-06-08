<?php

namespace App\Models\Teknisi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals'; //

    protected $fillable = [
        'teknisi_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
    ];

    // Relasi ke Teknisi (User dengan role teknisi)
    public function teknisi()
    {
        return $this->belongsTo(\App\Models\User::class, 'teknisi_id');
    }
}
