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

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}
