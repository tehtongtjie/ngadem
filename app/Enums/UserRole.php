<?php
namespace App\Enums;

enum UserRole: string
{
    case admin = 'admin';
    case teknisi = 'teknisi';
    case customer = 'customer';
}
