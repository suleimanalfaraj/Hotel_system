<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\invoices;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\rooms;
use App\Models\User;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{


    public function index()
    {
        $invoices = Invoice::all();
        return view('backend.invoices.index', compact('invoices'));
    }


    public function create()
    {
        $rooms = Room::all();  
        $reservations = Reservation::all();  
        $invoiceNumber = 'INV-' . strtoupper(uniqid());

        return view('backend.invoices.create', compact('rooms', 'reservations', 'invoiceNumber'));
    }

    public function createInvoice(Request $request)
    {
        
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'room_id' => 'required|exists:rooms,id',
            'invoice_number' => 'required|string|unique:invoices,invoice_number',
            'invoice_Date' => 'required|date',
            'Due_date' => 'required|date|after_or_equal:invoice_Date',
            'Amount_collection' => 'required|numeric|min:0',
            'Amount_Commission' => 'required|numeric|min:0',
            'Discount' => 'required|numeric|min:0',
            'Value_VAT' => 'required|numeric|min:0',
            'Rate_VAT' => 'required|string',
            'Total' => 'required|numeric|min:0',
            'Status' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $invoice = new Invoice();
        $invoice->invoice_number = $request->invoice_number;
        $invoice->invoice_Date = $request->invoice_Date;
        $invoice->Due_date = $request->Due_date;
        $invoice->Amount_collection = $request->Amount_collection;
        $invoice->Amount_Commission = $request->Amount_Commission;
        $invoice->Discount = $request->Discount;
        $invoice->Value_VAT = $request->Value_VAT;
        $invoice->Rate_VAT = $request->Rate_VAT;
        $invoice->Total = $request->Total;
        $invoice->Status = $request->Status;
        $invoice->Value_Status = 1; 
        $invoice->reservation_id = $request->reservation_id;
        $invoice->room_id = $request->room_id;
        $invoice->note = $request->note;
        $invoice->save();

        return redirect()->route('reservations.show', $request->reservation_id)->with('success', 'تم إضافة الفاتورة بنجاح');
    }


    public function store(Request $request)
    {
        //add the invoice number automatically
        $lastInvoice = Invoice::orderBy('id', 'desc')->first();
        $invoiceNumber = 'INV-' . str_pad(($lastInvoice ? substr($lastInvoice->invoice_number, 4) + 1 : 1), 5, '0', STR_PAD_LEFT);
        
        // حساب الإجمالي (المبلغ المستحق - الخصم + الضريبة)
        $totalAmount = $request->Amount_collection - $request->Discount + $request->Value_VAT;
    
        $invoice = new Invoice();
        $invoice->invoice_number = $invoiceNumber;
        $invoice->invoice_Date = $request->invoice_Date;
        $invoice->Due_date = $request->Due_date;
        $invoice->Amount_collection = $request->Amount_collection;
        $invoice->Amount_Commission = $request->Amount_Commission;
        $invoice->Discount = $request->Discount;
        $invoice->Value_VAT = $request->Value_VAT;
        $invoice->Total = $totalAmount; 
        $invoice->note = $request->note;
        $invoice->Payment_Date = $request->Payment_Date;
        $invoice->reservation_id = $request->reservation_id;
        $invoice->room_id = $request->room_id;
        $invoice->save();
        
        return redirect()->route('invoices.index')->with('success', 'تم إضافة الفاتورة بنجاح');
    }
    

    public function show($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        return view('invoices.status_update', compact('invoices'));
    }

    public function edit($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        return view('backend.invoices.edit', compact('invoices'));
    }
    
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
    
        // حساب الإجمالي مجددًا
        $totalAmount = $request->Amount_collection - $request->Discount + $request->Value_VAT;
    
        $invoice->update([
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Total' => $totalAmount,
            'note' => $request->note,
            'Status' => $request->Status,
        ]);
    
        return redirect()->route('invoices.index')->with('success', 'تم تحديث الفاتورة بنجاح');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'تم حذف الفاتورة بنجاح');
    }
}

