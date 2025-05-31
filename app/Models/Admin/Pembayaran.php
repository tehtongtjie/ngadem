<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pembayaran extends Model
{
    // Nama tabel jika tidak sesuai konvensi (opsional)
    protected $table = 'payments'; // sesuaikan jika tabelnya bernama lain

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'order_id',
        'metode_pembayaran',
        'jumlah_bayar',
        'status_pembayaran',
        'tanggal_pembayaran',
        'bukti_pembayaran',
    ];

    // Casting tipe data agar otomatis konversi tipe
    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
        'tanggal_pembayaran' => 'datetime',
    ];

    // Default value untuk atribut (jika mau set manual, Laravel 9+ bisa pakai $attributes)
    protected $attributes = [
        'status_pembayaran' => 'pending',
    ];

    // Jika ingin menambahkan accessor/mutator untuk enum status, contoh:
    // (Laravel 9+ enum casting juga bisa menggunakan enum class, tapi ini cara sederhana)

    /**
     * Validasi status pembayaran dengan enum
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

    // Relasi ke order (jika ada model Order)
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id');
    }
}
