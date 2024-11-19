<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVoucher extends Model
{
    use HasFactory;


    protected $fillable = [
        'reservation_id',
        'date',
        'time',
        'purpose',
        'expense_item',
        'supplier',
        'amount',
        'payment_method',
        'notes',
    ];

    /**
     * العلاقة مع جدول الحجوزات
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
