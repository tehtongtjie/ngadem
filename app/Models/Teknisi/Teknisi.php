<?php

namespace App\Models\Teknisi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // jika terkait dengan user login
        'nama',
        'email',
        'nomor_hp',
        'keahlian',
        'pengalaman',
        'alamat',
        'foto_profil',
    ];
}
