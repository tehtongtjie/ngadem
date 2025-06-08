<?php

namespace App\Models\Teknisi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teknisi\Order;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'nama_layanan', 'deskripsi', 'harga_dasar', 'status'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
