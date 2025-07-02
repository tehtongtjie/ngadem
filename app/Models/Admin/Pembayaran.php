<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pembayaran extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'order_id',
        'metode_pembayaran',
        'jumlah_bayar',
        'status_pembayaran',
        'tanggal_pembayaran',
        'bukti_pembayaran',
    ];

    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
        'tanggal_pembayaran' => 'datetime',
    ];

    protected $attributes = [
        'status_pembayaran' => 'pending',
    ];

    /**
     * 
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_BERHASIL = 'berhasil';
    public const STATUS_GAGAL = 'gagal';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_BERHASIL,
            self::STATUS_GAGAL,
        ];
    }

    public function order()
    {
        return $this->belongsTo(\App\Models\Customer\Order::class, 'order_id');
    }
}
