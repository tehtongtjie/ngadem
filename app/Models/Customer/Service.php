<?php

namespace App\Models\Customer; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model // PASTI Service
{
    use HasFactory;

    protected $table = 'services';
    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'harga_dasar',
        'status',
    ];
    protected $casts = [
        'harga_dasar' => 'decimal:2',
        'status' => 'string',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class); // Order::class akan resolve ke App\Models\Customer\Order
    }
}