@extends('backend.layout.admin')

 @section('name-page')
     Add Invioices
 @stop


@section('content')
<div class="container">
    <h2>إضافة فاتورة جديدة</h2>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="form-row">
 
        <!-- حقل رقم الفاتورة، يتم عرضه ولكن غير قابل للتعديل -->
        <div class="form-group">
            <label for="invoice_number">رقم الفاتورة:</label>
            <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ $invoiceNumber }}" readonly>
            @error('invoice_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

            <div class="form-group col-md-6">
                <label for="reservation_id">رقم الحجز:</label>
                <select name="reservation_id" class="form-control" id="reservation_id" required>
                    <option value="">اختر رقم الحجز</option>
                    @foreach($reservations as $reservation)
                        <option value="{{ $reservation->id }}">{{ $reservation->reservation_number }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Amount_collection">مبلغ التحصيل:</label>
                <input type="number" step="0.01" class="form-control" id="Amount_collection" name="Amount_collection" value="{{ old('Amount_collection') }}" required>
            </div>

            <div class="form-group col-md-6">
                <label for="Amount_Commission">مبلغ العمولة:</label>
                <input type="number" step="0.01" class="form-control" id="Amount_Commission" name="Amount_Commission" value="{{ old('Amount_Commission') }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Discount">الخصم:</label>
                <input type="number" step="0.01" class="form-control" id="Discount" name="Discount" value="{{ old('Discount') }}" required>
            </div>

            <div class="form-group col-md-6">
                <label for="Value_VAT">قيمة ضريبة القيمة المضافة (VAT):</label>
                <input type="number" step="0.01" class="form-control" id="Value_VAT" name="Value_VAT" value="{{ old('Value_VAT') }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Rate_VAT">معدل ضريبة القيمة المضافة (VAT Rate):</label>
                <input type="text" class="form-control" id="Rate_VAT" name="Rate_VAT" value="{{ old('Rate_VAT') }}" required>
            </div>

            <div class="form-group col-md-6">
                <label for="Total">المجموع الكلي:</label>
                <input type="number" step="0.01" class="form-control" id="Total" name="Total" value="{{ old('Total') }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="Status">الحالة:</label>
                <input type="text" class="form-control" id="Status" name="Status" value="{{ old('Status') }}" required>
            </div>

            <div class="form-group col-md-6">
                <label for="Value_Status">قيمة الحالة:</label>
                <input type="number" class="form-control" id="Value_Status" name="Value_Status" value="{{ old('Value_Status') }}" required>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="room_id">رقم الغرفة:</label>
            <select name="room_id" class="form-control" id="room_id" required>
                <option value="">اختر رقم الغرفة</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="note">ملاحظات:</label>
            <textarea class="form-control" id="note" name="note" rows="3">{{ old('note') }}</textarea>
        </div>

        <div class="form-group">
            <label for="Payment_Date">تاريخ الدفع:</label>
            <input type="date" class="form-control" id="Payment_Date" name="Payment_Date" value="{{ old('Payment_Date') }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">إضافة الفاتورة</button>
        </div>
    </form>
</div>


 @endsection
