<?php

namespace App\Models\Teknisi;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TeknisiDetail extends Model
{
    protected $table = 'teknisi_details';

    protected $fillable = [
        'user_id', 'area_layanan', 'spesialisasi', 'rating', 'jumlah_ulasan', 'deskripsi_singkat', 'foto_profil'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
