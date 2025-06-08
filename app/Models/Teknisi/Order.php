<?php

namespace App\Models\Teknisi;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Teknisi\Service;
use App\Models\Teknisi\Payment;
use App\Models\Teknisi\Review;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'teknisi_id', 'service_id', 'tanggal_pesanan', 'tanggal_service_diharapkan', 'jam_service_diharapkan',
        'alamat_service', 'deskripsi_masalah', 'status_order', 'total_harga'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
