<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// موديل Receipt
class Receipt extends Model
{
    use HasFactory;

 
    protected $fillable = [
        'reservation_id',
        'room_id',
        'receipt_number',
        'purpose',
        'payment_method',
        'amount',
        'description',
        'date',
        'time',
    ];

    // Define relationships
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // علاقة مع العميل عبر الحجز
    // public function customer()
    // {
    //     return $this->belongsToThrough(Customer::class, Reservation::class);
    // }
}

