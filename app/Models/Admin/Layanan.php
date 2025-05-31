<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    
    protected $table = 'services';

    // Kolom yang dapat diisi mass assignment
    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'harga_dasar',
        'status',
    ];
}
