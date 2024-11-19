<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CustomerControllers extends Controller
{
    public function index()
    {
        $reservations = Reservation::select
        ('name', 'phone', 'gender', 'nationality', 'national_id')->get();
        
        return view('backend.customers.index', compact('reservations'));
    }
}
