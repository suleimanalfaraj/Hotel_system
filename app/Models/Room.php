<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// موديل Room
class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'room_type',
        'price',
        'status',
        'description',
        'is_cleaning'
    ];

    // علاقة مع الفواتير
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }


    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }
}
