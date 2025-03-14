<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'customer_name', // Tambahkan ini
        'service_type',
        'booking_date',
        'total_price',
        'payment_status',
        'midtrans_transaction_id',
    ];

}
