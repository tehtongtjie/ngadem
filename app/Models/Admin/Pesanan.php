<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'teknisi_id',
        'service_id',
        'tanggal_pesanan',
        'tanggal_service_diharapkan',
        'jam_service_diharapkan',
        'alamat_service',
        'deskripsi_masalah',
        'status_order',
        'total_harga',
    ];

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    // Relasi ke user (customer)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke layanan/service
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
