<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// موديل Reservation
class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_number', 
        'rental_type', 
        'check_in', 
        'check_out', 
        'room_id', 
        'status',
        'name', 
        'phone', 
        'gender', 
        'nationality', 
        'national_id'
    ];

    // علاقة مع الغرفة
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // علاقة مع الفواتير
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    // علاقة مع السندات
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function paymentVouchers()
    {
        return $this->hasMany(PaymentVoucher::class);
    }

    
}