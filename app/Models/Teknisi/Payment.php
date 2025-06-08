<?php

namespace App\Models\Teknisi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teknisi\Order;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'order_id', 'metode_pembayaran', 'jumlah_bayar', 'status_pembayaran', 'tanggal_pembayaran', 'bukti_pembayaran'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
