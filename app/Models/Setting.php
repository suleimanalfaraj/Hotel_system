<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';


    protected $fillable = [
        'hotel_name',
        'tax_number',
        'company_number',
        'email',
        'city',
        'street',
    ];
}
