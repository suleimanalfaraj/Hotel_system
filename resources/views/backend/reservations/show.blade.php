@extends('backend.layout.admin')

@section('name-page')
    تفاصيل الحجز
@stop

@section('content')

    <style>
        /* تحسين مظهر الجدول */
        table {
            border-radius: 10px;
            overflow: hidden;
        }

        /* تخصيص رأس الجدول */
        .thead-dark th {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            font-weight: bold;
        }

        /* تخصيص الخلايا */
        td,
        th {
            padding: 10px;
            vertical-align: middle;
            text-align: center;
        }

        /* تأثير hover على الصفوف */
        tr:hover {
            background-color: #f1f1f1;
        }

        /* تخصيص الأزرار */
        .btn {
            border-radius: 5px;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        /* تخصيص الأزرار عند التحويم */
        .btn:hover {
            opacity: 0.8;
        }

        /* تخصيص رأس الصفحة */
        h2 {
            font-family: 'Arial', sans-serif;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }
    </style>

    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">

        <!-- الأزرار الأساسية -->
        <div class="d-flex justify-content-between mb-3">
            <div>

                <!-- زر فتح المودال -->
                <button class="btn btn-success" data-toggle="modal" data-target="#addReceiptModal">إضافة سند قبض</button>
                <!-- مودال إضافة سند قبض -->
                <div class="modal fade" id="addReceiptModal" tabindex="-1" role="dialog"
                    aria-labelledby="addReceiptModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addReceiptModalLabel">إضافة سند قبض</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('receipts.store') }}" method="POST">
                                    @csrf
                                    <!-- Hidden fields for reservation_id and room_id -->
                                    <input type="hidden" name="reservation_id" value="{{ $reservations->id }}">
                                    <input type="hidden" name="room_id" value="{{ $reservations->room_id }}">

                                    {{-- <div class="form-group">
                                        <label for="receipt_number">رقم السند</label>
                                        <input type="text" name="receipt_number" id="receipt_number" class="form-control"
                                            value="" readonly required>
                                    </div> --}}

                                    <!-- Receipt Number (Will be generated in the controller) -->
                                    <div class="form-group">
                                        <label for="receipt_number">رقم السند :</label>
                                        <input type="text" class="form-control" id="receipt_number" name="receipt_number"
                                            value="{{ old('receipt_number') }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="purpose">الغرض</label>
                                        <input type="text" name="purpose" id="purpose" class="form-control"
                                            value=" وذالك عن إيجار الغرفة رقم {{ $reservations->room->room_number }}"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_method">طريقة الدفع</label>
                                        <select name="payment_method" id="payment_method" class="form-control" required>
                                            <option value="Cash">نقداً</option>
                                            <option value="Bank">عن طريق البنك</option>
                                            <option value="Online">عبر الإنترنت</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount">المبلغ</label>
                                        <input type="number" name="amount" id="amount" class="form-control"
                                            value="{{ $reservations->room->price }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">الوصف</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>

                                    <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                                    <input type="hidden" name="time" value="{{ date('H:i:s') }}">

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                        <button type="submit" class="btn btn-success">حفظ</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- زر إضافة سند صرف  + مودال إضافة سند الصرف -->
                <button class="btn btn-danger" data-toggle="modal" data-target="#addPaymentModal">إضافة سند صرف</button>
                <!-- مودال إضافة سند صرف -->
                <div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog"
                    aria-labelledby="addPaymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPaymentModalLabel">إضافة سند صرف</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('payment-vouchers.store') }}" method="POST">
                                    @csrf

                                    <!-- Hidden fields for reservation_id and room_id -->
                                    <input type="hidden" name="reservation_id" value="{{ $reservations->id }}">
                                    <input type="hidden" name="room_id" value="{{ $reservations->room_id }}">
                                    {{-- <!-- نوع السند -->
                                    <div class="form-group">
                                        <label for="payment_number">نوع السند:</label>
                                        <input type="text" class="form-control" id="payment_number"
                                            name="payment_number" required>
                                    </div> --}}

                                    <div class="form-group">
                                        <label for="paymentDate">التاريخ</label>
                                        <input type="date" class="form-control" id="paymentDate" name="date"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="paymentTime">الوقت</label>
                                        <input type="time" class="form-control" id="paymentTime" name="time"
                                            required>
                                    </div>

                                    <!-- المبلغ -->
                                    <div class="form-group">
                                        <label for="amount">المبلغ:</label>
                                        <input type="number" class="form-control" id="amount" name="amount"
                                            required>
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
                                        <input type="text" class="form-control" id="supplier" name="supplier"
                                            placeholder="أدخل اسم المورد/المستفيد" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="purpose">الغرض</label>
                                        <input type="text" class="form-control" id="purpose" name="purpose"
                                            placeholder="أدخل الغرض من السند" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="expenseItem">بند الصرف</label>
                                        <input type="text" class="form-control" id="expenseItem" name="expense_item"
                                            placeholder="أدخل بند الصرف" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="notes">ملاحظات</label>
                                        <textarea class="form-control" id="notes" name="notes" placeholder="أدخل أي ملاحظات إضافية"></textarea>
                                    </div>

                                    <!-- زر إرسال النموذج -->
                                    <button type="submit" class="btn btn-primary">إضافة سند صرف</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button to trigger modal -->
                <a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#addInvoiceModal">إضافة
                    فواتير</a>
                <!-- Modal to add invoice -->
                <div class="modal fade" id="addInvoiceModal" tabindex="-1" role="dialog"
                    aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addInvoiceModalLabel">إضافة فاتورة</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('invoices.store') }}" method="POST">
                                    @csrf
                                    <!-- Hidden fields for reservation_id and room_id -->
                                    <input type="hidden" name="reservation_id" value="{{ $reservations->id }}">
                                    <input type="hidden" name="room_id" value="{{ $reservations->room_id }}">

                                    <!-- Invoice Number -->
                                    <div class="form-group">
                                        <label for="invoice_number">رقم الفاتورة:</label>
                                        <input type="text" class="form-control" id="invoice_number"
                                            name="invoice_number" value="{{ $newInvoiceNumber }}" readonly>
                                    </div>

                                    <!-- Amount Collection -->
                                    <div class="form-group">
                                        <label for="Amount_collection">المبلغ المستحق:</label>
                                        <input type="number" class="form-control" id="Amount_collection"
                                            name="Amount_collection" required>
                                    </div>

                                    <!-- VAT Value -->
                                    <div class="form-group">
                                        <label for="Value_VAT">قيمة الضريبة:</label>
                                        <input type="number" class="form-control" id="Value_VAT" name="Value_VAT"
                                            required>
                                    </div>

                                    <!-- Invoice Date -->
                                    <div class="form-group">
                                        <label for="invoice_Date">تاريخ الفاتورة:</label>
                                        <input type="date" class="form-control" id="invoice_Date" name="invoice_Date"
                                            required>
                                    </div>

                                    <!-- Due Date -->
                                    <div class="form-group">
                                        <label for="Due_date">تاريخ الاستحقاق:</label>
                                        <input type="date" class="form-control" id="Due_date" name="Due_date"
                                            required>
                                    </div>

                                    <!-- Commission Amount -->
                                    <div class="form-group">
                                        <label for="Amount_Commission">العمولة:</label>
                                        <input type="number" class="form-control" id="Amount_Commission"
                                            name="Amount_Commission" required>
                                    </div>

                                    <!-- Discount -->
                                    <div class="form-group">
                                        <label for="Discount">الخصم:</label>
                                        <input type="number" class="form-control" id="Discount" name="Discount"
                                            required>
                                    </div>


                                    <!-- Total Amount -->
                                    <div class="form-group">
                                        <label for="Total">الإجمالي:</label>
                                        <input type="number" class="form-control" id="Total" name="Total"
                                            required readonly>
                                    </div>

                                    <!-- Notes -->
                                    <div class="form-group">
                                        <label for="note">الوصف:</label>
                                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary">إضافة فاتورة</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- زر للانتقال إلى قسم المعاملات المالية -->
    <div class="text-center mb-4">
        <button onclick="document.getElementById('financial-transactions').scrollIntoView({ behavior: 'smooth' })"
            class="btn btn-primary">
            عرض المعاملات المالية
        </button>
    </div>


    <!-- عنوان الجدول -->
    <h2 class="text-center mb-4">تفاصيل الحجز</h2>

    <!-- الجدول -->
    <table class="table table-hover table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>رقم الحجز</th>
                <th>الاسم</th>
                <th>رقم الجوال</th>
                <th>الهوية الوطنية</th>
                <th>الجنس</th>
                <th>الجنسية</th>
                <th>تاريخ الوصول</th>
                <th>تاريخ المغادرة</th>
                <th>رقم الغرفة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $reservations->reservation_number }}</td>
                <td>{{ $reservations->name }}</td>
                <td>{{ $reservations->phone }}</td>
                <td>{{ $reservations->national_id }}</td>
                <td>{{ $reservations->gender }}</td>
                <td>{{ $reservations->nationality }}</td>
                <td>{{ $reservations->check_in }}</td>
                <td>{{ $reservations->check_out }}</td>
                <td>{{ $room->room_number }}</td>
                <td>
                    <!-- زر تعديل -->
                    <a href="{{ route('reservations.edit', $reservations->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> تعديل
                    </a>

                    <!-- زر طباعة -->
                    <a href="{{ route('reservations.print', $reservations->id) }}" class="btn btn-info btn-sm"
                        target="_blank">
                        <i class="fas fa-print"></i> طباعة
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    </div>



    <!-- قسم المعاملات المالية -->
    <h2 id="financial-transactions" class="text-center mb-4">المعاملات المالية</h2>

    <!-- جدول المعاملات المالية -->
    <table class="table table-hover table-bordered text-center mb-4">
        <thead class="thead-dark">
            <tr>
                <th>رقم المعاملة</th>
                <th>نوع المعاملة</th>
                <th>التاريخ</th>
                <th>المبلغ</th>
                <th>الوصف</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations->invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>فاتورة</td>
                    <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                    <td>{{ $invoice->total }}</td>
                    <td>{{ $invoice->description ?? 'N/A' }}</td>
                </tr>
            @endforeach

            @foreach ($reservations->receipts as $receipt)
                <tr>
                    <td>{{ $receipt->receipt_number }}</td>
                    <td>سند</td>
                    <td>{{ $receipt->created_at->format('Y-m-d') }}</td>
                    <td>{{ $receipt->amount }}</td>
                    <td>{{ $receipt->description ?? 'N/A' }}</td>
                </tr>
            @endforeach

            @foreach ($reservations->receipts as $receipt)
                <tr>
                    <td>{{ $receipt->receipt_number }}</td>
                    <td>سند قبض</td>
                    <td>{{ $receipt->created_at->format('Y-m-d') }}</td>
                    <td>{{ $receipt->amount }}</td>
                    <td>{{ $receipt->description ?? 'N/A' }}</td>
                </tr>
            @endforeach

            @foreach ($reservations->paymentVouchers as $voucher)
                <tr>
                    <td>{{ $voucher->id }}</td> <!-- أو أي رقم مرجعي إن وجد -->
                    <td>سند صرف</td>
                    <td>{{ $voucher->date }}</td>
                    <td>{{ $voucher->amount }}</td>
                    <td>{{ $voucher->purpose ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <script>
        // Function to generate a sequential receipt number
        function generateReceiptNumber() {
            // Retrieve the last receipt number from local storage (or session) if available
            let lastReceiptNumber = localStorage.getItem('lastReceiptNumber') || 0;

            // Increment the receipt number by 1
            let newReceiptNumber = parseInt(lastReceiptNumber) + 1;

            // Format the number to always be 5 digits
            let formattedReceiptNumber = String(newReceiptNumber).padStart(5, '0');

            // Save the new receipt number back to local storage for the next session
            localStorage.setItem('lastReceiptNumber', newReceiptNumber);

            // Set the generated receipt number in the input field
            document.getElementById('receipt_number').value = formattedReceiptNumber;
        }

        // Call the function to generate the number when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            generateReceiptNumber();
        });
    </script>

@endsection






























<!-- VAT Rate -->
{{-- <div class="form-group">
                        <label for="Rate_VAT">معدل الضريبة:</label>
                        <input type="text" class="form-control" id="Rate_VAT" name="Rate_VAT" required>
                    </div>
                 --}}
{{--                 
                    <!-- Status -->
                    <div class="form-group">
                        <label for="Status">الحالة:</label>
                        <input type="text" class="form-control" id="Status" name="Status" required>
                    </div> --}}


<!-- سكربت لحساب الإجمالي تلقائيًا -->
{{-- <script>
        // كلما تغيرت قيمة المبلغ أو العمولة أو الخصم أو الضريبة، سيتم تحديث الإجمالي
        document.querySelectorAll('#Amount_collection, #Amount_Commission, #Discount, #Value_VAT').forEach(function(input) {
            input.addEventListener('input', function() {
                var amount = parseFloat(document.getElementById('Amount_collection').value) || 0;
                var commission = parseFloat(document.getElementById('Amount_Commission').value) || 0;
                var discount = parseFloat(document.getElementById('Discount').value) || 0;
                var vat = parseFloat(document.getElementById('Value_VAT').value) || 0;

                var total = amount + commission - discount + vat;
                document.getElementById('Total').value = total.toFixed(2); // تحديث الإجمالي
            });
        });
    </script> --}}

{{-- <div class="mb-3 text-center">
        <button class="btn btn-success" data-toggle="modal" data-target="#addReceiptModal">إضافة سند قبض</button>
        <button class="btn btn-danger" data-toggle="modal" data-target="#addPaymentModal">إضافة سند صرف</button>
        <button class="btn btn-danger" data-toggle="modal" data-target="#addPaymentModal">اضافة فواتير</button>
    </div> --}}
{{-- 
<div class="container mt-5">
    <h2 class="text-center mb-4">تفاصيل الحجز</h2>

    <!-- Card container for reservations details -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">تفاصيل العميل</h4>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>الاسم</th>
                        <td>{{ $reservations->name }}</td>
                    </tr>
                    <tr>
                        <th>رقم الجوال</th>
                        <td>{{ $reservations->phone }}</td>
                    </tr>
                    <tr>
                        <th>الجنس</th>
                        <td>{{ $reservations->gender }}</td>
                    </tr>
                    <tr>
                        <th>الجنسية</th>
                        <td>{{ $reservations->nationality }}</td>
                    </tr>
                    <tr>
                        <th>رقم الهوية</th>
                        <td>{{ $reservations->national_id }}</td>
                    </tr>
                    <tr>
                        <th>تاريخ الوصول</th>
                        <td>{{ $reservations->check_in }}</td>
                    </tr>
                    <tr>
                        <th>تاريخ المغادرة</th>
                        <td>{{ $reservations->check_out }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Card container for Room details -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">تفاصيل الغرفة</h4>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>رقم الغرفة</th>
                        <th>سعر الغرفة</th>
                        <th>نوع الغرفة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->price }}</td>
                            <td>{{ $room->room_type }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('reservationss.index') }}" class="btn btn-primary btn-sm">العودة إلى القائمة</a>
    </div>
</div> --}}
