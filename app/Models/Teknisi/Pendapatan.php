<?php

namespace App\Models\Teknisi;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pendapatan extends Model
{
    protected $table = 'pendapatan';

    protected $fillable = [
        'teknisi_id', 'total_pendapatan', 'periode'
    ];

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}
