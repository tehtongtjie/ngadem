<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Customer\Service;
use App\Models\Customer\Payment;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id', 'teknisi_id', 'service_id', 'tanggal_service_diharapkan',
        'jam_service_diharapkan', 'alamat_service', 'deskripsi_masalah',
        'status_order', 'total_harga', 'tanggal_pesanan',
    ];
    protected $casts = [
        'tanggal_pesanan' => 'datetime',
        'tanggal_service_diharapkan' => 'date',
        'jam_service_diharapkan' => 'datetime',
        'total_harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function scopeStatus($query, $status)
    {
        return $query->where('status_order', $status);
    }
    public function getTotalHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }
}