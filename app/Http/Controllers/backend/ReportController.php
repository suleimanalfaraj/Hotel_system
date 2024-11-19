<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Receipt;
use App\Models\reports;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function index()
    {
        return view('backend.reports.index');
    }

    public function financial(Request $request)
    {
        $queryInvoices = Invoice::query();
        $queryReceipts = Receipt::query();

        // تصفية الفواتير بناءً على التواريخ
        if ($request->start_date) {
            $queryInvoices->where('invoice_Date', '>=', $request->start_date);
            $queryReceipts->where('date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $queryInvoices->where('invoice_Date', '<=', $request->end_date);
            $queryReceipts->where('date', '<=', $request->end_date);
        }

        // تصفية الفواتير وسندات القبض بناءً على طريقة الدفع
        if ($request->payment_method) {
            $queryReceipts->where('payment_method', $request->payment_method);
        }

        $invoices = $queryInvoices->get();
        $receipts = $queryReceipts->get();

        return view('backend.reports.financial', compact('invoices', 'receipts'));
    }

    public function room_report(Request $request)
    {
        $filter_date = $request->input('filter_date');

        // Get all rooms with related data
        $rooms = Room::with(['invoices', 'reservation'])->get();
    
        // Query daily reservations with optional date filter
        $daily_reservations = Reservation::selectRaw('count(*) as count, DATE(check_in) as date')
            ->when($filter_date, function ($query, $filter_date) {
                return $query->whereDate('check_in', $filter_date);
            })
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();
    
        // Query monthly reservations
        $monthly_reservations = Reservation::selectRaw('count(*) as count, MONTH(check_in) as month, YEAR(check_in) as year')
            ->groupBy('month', 'year')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('backend.reports.room_report', compact('rooms', 'daily_reservations', 'monthly_reservations', 'filter_date'));
    }
}
