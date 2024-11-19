<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentVoucher;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PaymentVoucherController extends Controller
{

    public function index()
    {
        $paymentVouchers = PaymentVoucher::all();
        $reservations = Reservation::select('id', 'reservation_number')->get();
    
        return view('backend.payment-vouchers.payment-vouchers', compact('paymentVouchers', 'reservations'));
    }


    public function create()
    {
        $reservations = Reservation::all(); 
        return view('backend.payment-vouchers.create', compact('reservations'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'reservation_id' => 'nullable|exists:reservations,id',
            'date' => 'required|date',
            'time' => 'required',
            'purpose' => 'required|string|max:255',
            'expense_item' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);
        $validatedData['reservation_id'] = $validatedData['reservation_id'] ?? null;

        PaymentVoucher::create($request->all());

        return redirect()->route('payment-vouchers.index')
            ->with('success', 'تم إنشاء سند الصرف بنجاح.');
    }


    public function show(PaymentVoucher $paymentVoucher)
    {
        return view('backend.payment-vouchers.show', compact('paymentVoucher'));
    }


    public function edit(PaymentVoucher $paymentVoucher)
    {
        $reservations = Reservation::select('id', 'reservation_number', 'name')->get();
        return view('backend.payment-vouchers.edit', compact('paymentVoucher', 'reservations'));
    }


    public function update(Request $request, PaymentVoucher $paymentVoucher)
    {
        $request->validate([
            'reservation_id' => 'nullable|exists:reservations,id',
            'date' => 'required|date',
            'time' => 'required',
            'purpose' => 'required|string|max:255',
            'expense_item' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $paymentVoucher->update($request->all());

        return redirect()->route('payment-vouchers.index')
            ->with('success', 'تم تحديث سند الصرف بنجاح.');
    }


    public function destroy(PaymentVoucher $paymentVoucher)
    {
        $paymentVoucher->delete();
        return redirect()->route('payment-vouchers.index')
            ->with('success', 'تم حذف سند الصرف بنجاح.');
    }
}
