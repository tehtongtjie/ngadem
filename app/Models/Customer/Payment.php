<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer\Order;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'order_id', 'metode_pembayaran', 'jumlah_bayar', 'status_pembayaran',
        'tanggal_pembayaran', 'bukti_pembayaran',
    ];
    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
        'tanggal_pembayaran' => 'datetime',
        'status_pembayaran' => 'string',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}