<?php

namespace App\Models\Customer; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
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
        return $this->hasMany(Order::class); 
    }
}