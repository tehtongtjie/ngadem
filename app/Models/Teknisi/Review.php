<?php

namespace App\Models\Teknisi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teknisi\Order;
use App\Models\User;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'order_id', 'user_id', 'teknisi_id', 'rating', 'komentar'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}
