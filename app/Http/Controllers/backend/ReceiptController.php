<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function index(Request $request)
    {
        $receipts = Receipt::all();
        return view('backend.receipts.index' , compact('receipts'));
    }


    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'room_id' => 'required|exists:rooms,id',
            'purpose' => 'required|string|max:255',
            'payment_method' => 'required|in:Cash,Bank,Online',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
        ]);
    
        $lastReceipt = Receipt::latest('id')->first();
        $newReceiptNumber = $lastReceipt ? $lastReceipt->receipt_number + 1 : 1;
        $formattedReceiptNumber = str_pad($newReceiptNumber, 5, '0', STR_PAD_LEFT);
        // Add the formatted receipt number to the validated data
        $validated['receipt_number'] = $formattedReceiptNumber;
  
        $receipt = Receipt::create($validated);
    
        // Update the remaining amount in the reservation
        $reservation = Reservation::find($validated['reservation_id']);
        if ($reservation) {
            $reservation->remaining_amount -= $receipt->amount; 
            if ($reservation->remaining_amount < 0) {
                $reservation->remaining_amount = 0; 
            }
            $reservation->save(); 
        }

        return redirect()->back()->with('success', 'تم إنشاء سند القبض وتحديث المبلغ المتبقي بنجاح.');
    }
        
}





























    // public function store(Request $request)
    // {
    //     // Validate incoming data
    //     $validated = $request->validate([
    //         'reservation_id' => 'required|exists:reservations,id',
    //         'room_id' => 'required|exists:rooms,id',
    //         'receipt_number' => 'required|string|max:255',
    //         'purpose' => 'required|string|max:255',
    //         'payment_method' => 'required|in:Cash,Bank,Online',
    //         'amount' => 'required|numeric|min:0',
    //         'description' => 'nullable|string',
    //         'date' => 'required|date',
    //         'time' => 'required|date_format:H:i:s',
    //     ]);

    //     // Create a new receipt
    //     Receipt::create($validated);

    //     // Redirect back with a success message or any response you desire
    //     return redirect()->back()->with('success', 'Receipt created successfully.');
    // }
