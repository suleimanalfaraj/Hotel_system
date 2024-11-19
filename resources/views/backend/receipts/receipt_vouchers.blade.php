@extends('backend.layout.admin')

@section('name-page')
    Add Invoices
@stop




@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>سندات القبض</h2>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addReceiptModal">
            <i class="fas fa-plus"></i> إضافة سند قبض
        </a>
    </div>

    <!-- جدول سندات القبض -->
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>رقم السند</th>
                <th>النوع</th>
                <th>المبلغ</th>
                <th>طريقة الدفع</th>
                <th>مستلم من </th>
                <th>الغرض</th>
                <th>رقم الحجز</th>
                <th>التاريخ / الوقت</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            <!-- يمكنك إضافة صفوف هنا -->
            <tr>
                <td>001</td>
                <td>2024-11-13</td>
                <td>500</td>
                <td>دفعة من العميل</td>
                <td>دفعة من العميل</td>
                <td>دفعة من العميل</td>
                <td>دفعة من العميل</td>
                <td>دفعة من العميل</td>
                <td>
                    <button class="btn btn-info btn-sm">تعديل</button>
                    <button class="btn btn-danger btn-sm">حذف</button>
                </td>
            </tr>
        </tbody>
    </table>
    </div>

    <!-- مودال إضافة سند قبض -->

    <div class="modal fade" id="addReceiptModal" tabindex="-1" aria-labelledby="addReceiptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReceiptModalLabel">إضافة سند قبض جديد</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="إغلاق">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <form id="receiptForm">
                        <!-- حقل رقم السند المخفي -->
                        <input type="hidden" id="receiptNumber" value="INV-{{ strtoupper(uniqid()) }}">

                        <!-- الحقول التي تحتوي على التاريخ والوقت الحاليين -->
                        <div class="form-group">
                            <label for="receiptDate">التاريخ</label>
                            <input type="text" class="form-control form-control-sm" id="receiptDate" readonly>
                        </div>
                        <div class="form-group">
                            <label for="receiptTime">الوقت</label>
                            <input type="text" class="form-control form-control-sm" id="receiptTime" readonly>
                        </div>

                        <div class="form-group">
                            <label for="receiptPurpose">الغرض</label>
                            <input type="text" class="form-control form-control-sm" id="receiptPurpose"
                                placeholder="أدخل الغرض من السند" required>
                        </div>
                        <div class="form-group">
                            <label for="paymentMethod">طريقة الدفع</label>
                            <select class="form-control form-control-sm" id="paymentMethod" required>
                                <option value="" disabled selected>اختر طريقة الدفع</option>
                                <option value="Cash">نقدًا</option>
                                <option value="Bank">عن طريق البنك</option>
                                <option value="Online">دفع إلكتروني</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="receiptAmount">المبلغ</label>
                            <input type="number" class="form-control form-control-sm" id="receiptAmount"
                                placeholder="أدخل المبلغ" required>
                        </div>
                        <div class="form-group">
                            <label for="receiptDescription">الوصف</label>
                            <textarea class="form-control form-control-sm" id="receiptDescription" placeholder="أدخل وصف السند" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">إلغاء</a>
                    <button type="submit" form="receiptForm" class="btn btn-primary">إضافة السند</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // جلب التاريخ والوقت الحاليين عند تحميل الصفحة ووضعهما في الحقول
        document.addEventListener("DOMContentLoaded", function() {
            const now = new Date();
            const date = now.toLocaleDateString('en-CA'); // صيغة YYYY-MM-DD
            const time = now.toLocaleTimeString('en-GB', {
                hour: '2-digit',
                minute: '2-digit'
            }); // صيغة HH:MM

            document.getElementById("receiptDate").value = date;
            document.getElementById("receiptTime").value = time;
        });
    </script>



@endsection
