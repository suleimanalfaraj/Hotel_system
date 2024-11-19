<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// موديل Invoice
class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'invoice_number', 'invoice_Date', 'Due_date', 'Amount_collection', 
        'Amount_Commission', 'Discount', 'Value_VAT', 'Total',  
        'note', 'Payment_Date', 'reservation_id', 'room_id'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
