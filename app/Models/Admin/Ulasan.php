<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'reviews'; 

    protected $fillable = [
        'order_id',
        'user_id',
        'teknisi_id',
        'rating',
        'komentar',
    ];

    // Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Relasi ke User yang memberi ulasan
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Teknisi yang diulas (juga user)
    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}
