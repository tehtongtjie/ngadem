<?php

namespace App\Models\Teknisi;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'teknisi_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_mulai' => 'datetime',
        'jam_selesai' => 'datetime',
    ];

    /**
     * Get the technician associated with the schedule.
     */
    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}