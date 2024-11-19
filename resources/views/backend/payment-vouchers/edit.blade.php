@extends('backend.layout.admin')

@section('name-page')
    edit Invoices
@stop



@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>تعديل سند صرف</h2>
        <a href="{{ route('payment-vouchers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> الرجوع إلى القائمة
        </a>
    </div>

    <form action="{{ route('payment-vouchers.update', $paymentVoucher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="reservation_id">نوع السند</label>
            <select class="form-control" id="reservation_id" name="reservation_id">
                <option value="">سند صرف عام</option>
                @foreach ($reservations as $reservation)
                <option value="{{ $reservation->id }}"
                    {{ $paymentVoucher->reservation_id == $reservation->id ? 'selected' : '' }}>
                    حجز رقم {{ $reservation->reservation_number }} - {{ $reservation->customer_name }} - {{ $reservation->date }}
                </option>
                @endforeach
            </select>
        </div>
        

        <div class="form-group">
            <label for="paymentDate">التاريخ</label>
            <input type="date" class="form-control" id="paymentDate" name="date" 
                value="{{ $paymentVoucher->date }}" required>
        </div>

        <div class="form-group">
            <label for="paymentTime">الوقت</label>
            <input type="time" class="form-control" id="paymentTime" name="time" 
                value="{{ $paymentVoucher->time }}" required>
        </div>

        <div class="form-group">
            <label for="paymentAmount">المبلغ</label>
            <input type="number" class="form-control" id="paymentAmount" name="amount" 
                value="{{ $paymentVoucher->amount }}" placeholder="أدخل المبلغ" required>
        </div>

        <div class="form-group">
            <label for="paymentMethod">طريقة الدفع</label>
            <select class="form-control" id="paymentMethod" name="payment_method" required>
                <option value="كاش" {{ $paymentVoucher->payment_method == 'كاش' ? 'selected' : '' }}>كاش</option>
                <option value="تحويل بنكي" {{ $paymentVoucher->payment_method == 'تحويل بنكي' ? 'selected' : '' }}>
                    تحويل بنكي
                </option>
                <option value="بطاقة ائتمان" {{ $paymentVoucher->payment_method == 'بطاقة ائتمان' ? 'selected' : '' }}>
                    بطاقة ائتمان
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="supplier">المورد/المستفيد</label>
            <input type="text" class="form-control" id="supplier" name="supplier" 
                value="{{ $paymentVoucher->supplier }}" placeholder="أدخل اسم المورد/المستفيد" required>
        </div>

        <div class="form-group">
            <label for="purpose">الغرض</label>
            <input type="text" class="form-control" id="purpose" name="purpose" 
                value="{{ $paymentVoucher->purpose }}" placeholder="أدخل الغرض من السند" required>
        </div>

        <div class="form-group">
            <label for="expenseItem">بند الصرف</label>
            <input type="text" class="form-control" id="expenseItem" name="expense_item" 
                value="{{ $paymentVoucher->expense_item }}" placeholder="أدخل بند الصرف" required>
        </div>

        <div class="form-group">
            <label for="notes">ملاحظات</label>
            <textarea class="form-control" id="notes" name="notes" placeholder="أدخل أي ملاحظات إضافية">{{ $paymentVoucher->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">تحديث السند</button>
    </form>
</div>
@endsection
