<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TeknisiDetail extends Model
{
    protected $table = 'teknisi_details';

    protected $fillable = [
        'user_id',
        'area_layanan',
        'spesialisasi',
        'rating',
        'jumlah_ulasan',
        'deskripsi_singkat',
        'foto_profil',
    ];

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class, 'user_id', 'id');
    }
}
