<?php

namespace App\Models\Customer; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // ... properti dan relasi model Anda
    protected $guarded = ['id']; // Contoh
    // protected $fillable = [...];
}