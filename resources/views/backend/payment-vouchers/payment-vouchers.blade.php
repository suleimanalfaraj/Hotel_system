@extends('backend.layout.admin')

@section('name-page')
    Add Invoices
@stop




@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center">
    <h2>سندات الصرف</h2>
    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPaymentModal">
        <i class="fas fa-plus"></i> إضافة سند صرف
    </a>
</div>

<!-- جدول سندات الصرف -->
<table class="table table-striped mt-4">
    <thead>
        <tr>
            <th>رقم السند</th>
            <th>التاريخ</th>
            <th>النوع</th>
            <th>المبلغ</th>
            <th>طريقة الدفع</th>
            <th>المورد/المستفيد</th>
            <th>الغرض</th>
            <th>بند الصرف</th>
            <th>رقم الحجز</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        <!-- تكرار للصفوف بناءً على البيانات -->
        @foreach ($paymentVouchers as $voucher)
        <tr>
            <td>{{ $voucher->id }}</td>
            <td>{{ $voucher->date }}</td>
            <td>{{ $voucher->reservation_id ? 'مرتبط بحجز' : 'عام' }}</td>
            <td>{{ number_format($voucher->amount, 2) }}</td>
            <td>{{ $voucher->payment_method }}</td>
            <td>{{ $voucher->supplier }}</td>
            <td>{{ $voucher->purpose }}</td>
            <td>{{ $voucher->expense_item }}</td>
            <td>{{ $voucher->reservation ? $voucher->reservation->reservation_number : '---' }}</td>
            <td>
                <a href="{{ route('payment-vouchers.edit', $voucher->id) }}" class="btn btn-info btn-sm">تعديل</a>
                <form action="{{ route('payment-vouchers.destroy', $voucher->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- عرض رسالة إذا لم يكن هناك بيانات -->
@if ($paymentVouchers->isEmpty())
<div class="alert alert-warning mt-4" role="alert">
    لا توجد بيانات لعرضها.
</div>
@endif

<!-- مودال إضافة سند صرف -->
<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentModalLabel">إضافة سند صرف جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('payment-vouchers.store') }}" method="POST" id="paymentForm">
                    @csrf

                    <div class="form-group">
                        <label for="reservation_id">نوع السند</label>
                        <select class="form-control" id="reservation_id" name="reservation_id">
                            <option value="">سند صرف عام</option>
                            @if ($reservations && $reservations->count() > 0)
                                @foreach ($reservations as $reservation)
                                    <option value="{{ $reservation->id }}">
                                        حجز رقم {{ $reservation->reservation_number }} - 
                                        {{ $reservation->name ?? 'بدون اسم' }} - 
                                        {{ $reservation->date ?? 'تاريخ غير محدد' }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>لا توجد حجوزات متاحة</option>
                            @endif
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="paymentDate">التاريخ</label>
                        <input type="date" class="form-control" id="paymentDate" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="paymentTime">الوقت</label>
                        <input type="time" class="form-control" id="paymentTime" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="paymentAmount">المبلغ</label>
                        <input type="number" class="form-control" id="paymentAmount" name="amount" placeholder="أدخل المبلغ" required>
                    </div>
                    <div class="form-group">
                        <label for="paymentMethod">طريقة الدفع</label>
                        <select class="form-control" id="paymentMethod" name="payment_method" required>
                            <option value="كاش">كاش</option>
                            <option value="تحويل بنكي">تحويل بنكي</option>
                            <option value="بطاقة ائتمان">بطاقة ائتمان</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supplier">المورد/المستفيد</label>
                        <input type="text" class="form-control" id="supplier" name="supplier" placeholder="أدخل اسم المورد/المستفيد" required>
                    </div>
                    <div class="form-group">
                        <label for="purpose">الغرض</label>
                        <input type="text" class="form-control" id="purpose" name="purpose" placeholder="أدخل الغرض من السند" required>
                    </div>
                    <div class="form-group">
                        <label for="expenseItem">بند الصرف</label>
                        <input type="text" class="form-control" id="expenseItem" name="expense_item" placeholder="أدخل بند الصرف" required>
                    </div>
                    <div class="form-group">
                        <label for="notes">ملاحظات</label>
                        <textarea class="form-control" id="notes" name="notes" placeholder="أدخل أي ملاحظات إضافية"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="submit" form="paymentForm" class="btn btn-primary">إضافة السند</button>
            </div>
        </div>
    </div>
</div>

@endsection
