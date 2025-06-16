<?php

namespace App\Models\Teknisi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 
class Teknisi extends Model
{
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // 'user_id' adalah foreign key di teknisi_details
    }

}