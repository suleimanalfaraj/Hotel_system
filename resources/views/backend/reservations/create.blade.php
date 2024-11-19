@extends('backend.layout.admin')

 @section('name-page')
     حجز جديد
 @stop
 @section('name-home')
     حجز جديد
 @stop
 @section('starter-page')
      الرئيسية
 @stop



 @section('content')
     <style>
         .table-container {
             max-width: 800px;
             margin: 0 auto;
             overflow-x: auto;
         }

         table {
             width: 100%;
         }

         th,
         td {
             text-align: center;
             vertical-align: middle;
         }

         .form-section {
             padding: 15px;
             border-radius: 8px;
             box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
             margin-bottom: 20px;
         }

         .btn-custom {
             width: 100%;
         }
     </style>
     {{-- code validat errores alert --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

 
 <div class="container mt-4 p-4 rounded" style="background-color: #f8f9fa;">
    
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <!-- رقم الحجز -->
        <div class="mb-3">
            <label for="reservation_number" class="form-label">رقم الحجز:</label>
            <input type="text" name="reservation_number" id="reservation_number" class="form-control"
                   value="{{ old('reservation_number', $newReservationNumber) }}" readonly required>
        </div>
    
        <!-- نوع الإيجار -->
        <div class="mb-3">
            <label for="rental_type" class="form-label">نوع الإيجار:</label>
            <select name="rental_type" id="rental_type" class="form-select" required>
                <option value="">اختر نوع الإيجار</option>
                <option value="يومي" {{ old('rental_type') == 'يومي' ? 'selected' : '' }}>يومي</option>
                <option value="أسبوعي" {{ old('rental_type') == 'أسبوعي' ? 'selected' : '' }}>أسبوعي</option>
                <option value="شهري" {{ old('rental_type') == 'شهري' ? 'selected' : '' }}>شهري</option>
            </select>
        </div>
    
        <!-- تواريخ الدخول والخروج -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="check_in" class="form-label">تاريخ الدخول:</label>
                <input type="date" name="check_in" id="check_in" class="form-control" value="{{ old('check_in') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="check_out" class="form-label">تاريخ الخروج:</label>
                <input type="date" name="check_out" id="check_out" class="form-control" value="{{ old('check_out') }}" required>
            </div>
        </div>
    
        <!-- اختيار الغرفة -->
        <div class="mb-3">
            <label for="room_id" class="form-label">اختر الغرفة:</label>
            <select name="room_id" id="room_id" class="form-select" required>
                <option value="">اختر الغرفة</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                        {{ $room->room_number }} - {{ $room->type }} - {{ $room->price }} ريال
                    </option>
                @endforeach
            </select>
        </div>
    
        <!-- حالة الحجز -->
        <div class="mb-3">
            <label for="status" class="form-label">حالة الحجز:</label>
            <select name="status" id="status" class="form-select" required>
                <option value="مؤكد" {{ old('status') == 'مؤكد' ? 'selected' : '' }}>مؤكد</option>
                <option value="مكتمل" {{ old('status') == 'مكتمل' ? 'selected' : '' }}>غير مؤكد</option>
            </select>
        </div>
    
        <!-- معلومات العميل -->
        <div class="mb-3">
            <label for="name" class="form-label">اسم العميل:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
    
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="inputphone">رقم الجوال</label>
                <input type="tel" name="phone" class="form-control" id="inputphone" placeholder="رقم الجوال" value="{{ old('phone') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="gender" class="form-label">الجنس:</label>
                <select name="gender" id="gender" class="form-select" required>
                    <option value="">اختر الجنس</option>
                    <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                    <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                </select>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nationality">الجنسية</label>
                <select name="nationality" class="form-select" id="nationality" required>
                    <option value="{{ old('nationality') }}">اختر الجنسية</option>
                    <!-- يمكنك إضافة المزيد من الجنسيات هنا -->
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="inputnational_id">رقم الهوية</label>
                <input type="number" name="national_id" class="form-control" id="inputnational_id" placeholder="رقم الهوية" value="{{ old('national_id') }}" maxlength="10" required>
            </div>
        </div>
    
        <!-- زر إرسال -->
        <button type="submit" class="btn btn-primary w-100 mt-3">إرسال الحجز</button>
    </form>
    
 </div>



     {{-- بداية المودل --}}
     <!-- Modal for Adding Invoice -->
     {{-- <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="invoiceModalLabel">إضافة فاتورة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for adding an invoice -->
                        <form>
                            <div class="form-group">
                                <label for="invoice_number">رقم الفاتورة</label>
                                <input type="text" class="form-control" id="invoice_number"
                                    placeholder="أدخل رقم الفاتورة">
                            </div>
                            <div class="form-group">
                                <label for="invoice_amount">المبلغ</label>
                                <input type="number" class="form-control" id="invoice_amount" placeholder="أدخل المبلغ">
                            </div>
                            <div class="form-group">
                                <label for="invoice_date">تاريخ الفاتورة</label>
                                <input type="date" class="form-control" id="invoice_date">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="button" class="btn btn-primary">حفظ الفاتورة</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Adding Receipt -->
        <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="receiptModalLabel">إضافة سند قبض</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for adding a receipt -->
                        <form>
                            <div class="form-group">
                                <label for="receipt_number">رقم سند القبض</label>
                                <input type="text" class="form-control" id="receipt_number"
                                    placeholder="أدخل رقم سند القبض">
                            </div>
                            <div class="form-group">
                                <label for="receipt_amount">المبلغ</label>
                                <input type="number" class="form-control" id="receipt_amount" placeholder="أدخل المبلغ">
                            </div>
                            <div class="form-group">
                                <label for="receipt_date">تاريخ سند القبض</label>
                                <input type="date" class="form-control" id="receipt_date">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="button" class="btn btn-primary">حفظ سند القبض</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Adding Payment Voucher -->
        <div class="modal fade" id="paymentVoucherModal" tabindex="-1" role="dialog"
            aria-labelledby="paymentVoucherModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentVoucherModalLabel">إضافة سند صرف</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for adding a payment voucher -->
                        <form>
                            <div class="form-group">
                                <label for="payment_voucher_number">رقم سند الصرف</label>
                                <input type="text" class="form-control" id="payment_voucher_number"
                                    placeholder="أدخل رقم سند الصرف">
                            </div>
                            <div class="form-group">
                                <label for="payment_voucher_amount">المبلغ</label>
                                <input type="number" class="form-control" id="payment_voucher_amount"
                                    placeholder="أدخل المبلغ">
                            </div>
                            <div class="form-group">
                                <label for="payment_voucher_date">تاريخ سند الصرف</label>
                                <input type="date" class="form-control" id="payment_voucher_date">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="button" class="btn btn-primary">حفظ سند الصرف</button>
                    </div>
                </div>
            </div>
        </div>  --}}
     {{-- نهاية المودل --}}

     <!-- JavaScript لتحديث السعر تلقائيًا -->
     <script>
         document.getElementById('room_id').addEventListener('change', function() {
             const selectedOption = this.options[this.selectedIndex];
             const roomPrice = selectedOption.getAttribute('data-price');
             document.getElementById('price').value = roomPrice ? roomPrice : '';
         });
     </script>

 @endsection


 {{-- @if ($errors->has('phone'))
                <div class="alert alert-danger">
                    {{ $errors->first('phone') }}
                </div>
            @endif
            @if ($errors->has('national_id'))
                <div class="alert alert-danger">
                    {{ $errors->first('national_id') }}
                </div>
            @endif
            @if ($errors->has('gender'))
                <div class="alert alert-danger">
                    {{ $errors->first('gender') }}
                </div>
            @endif --}}
 {{-- //code validat errores alert --}}


 <!-- مودال إضافة عميل -->

 {{-- 
    <div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="addClientModalLabel">إضافة عميل</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form>
                         <div class="form-group">
                             <label for="clientName">اسم العميل</label>
                             <input type="text" class="form-control" id="clientName" placeholder="أدخل اسم العميل">
                         </div>
                         <div class="form-group">
                             <label for="clientPhone">رقم الهاتف</label>
                             <input type="tel" class="form-control" id="clientPhone" placeholder="أدخل رقم الهاتف">
                         </div>
                         <div class="form-group">
                             <label for="clientEmail">البريد الإلكتروني</label>
                             <input type="email" class="form-control" id="clientEmail"
                                 placeholder="أدخل البريد الإلكتروني">
                         </div>
                     </form>
                 </div>
                 <div class="modal-footer form-group">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                     <button type="button" class="btn btn-primary">حفظ</button>
                 </div>
             </div>
         </div>
     </div> --}}


 {{-- 
    <!-- مودال إضافة شركة متعاقدة -->
     <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="addCompanyModalLabel">إضافة شركة متعاقدة</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form>
                         <div class="form-group">
                             <label for="companyName">اسم الشركة</label>
                             <input type="text" class="form-control" id="companyName" placeholder="أدخل اسم الشركة">
                         </div>
                         <div class="form-group">
                             <label for="companyContact">رقم الاتصال</label>
                             <input type="tel" class="form-control" id="companyContact"
                                 placeholder="أدخل رقم الاتصال">
                         </div>
                         <div class="form-group">
                             <label for="companyEmail">البريد الإلكتروني</label>
                             <input type="email" class="form-control" id="companyEmail"
                                 placeholder="أدخل البريد الإلكتروني">
                         </div>
                     </form>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                     <button type="button" class="btn btn-primary">حفظ</button>
                 </div>
             </div>
         </div>
     </div>

     <!-- Modal for Financial Information -->
     <div class="modal fade" id="financialModal" tabindex="-1" role="dialog" aria-labelledby="financialModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="financialModalLabel">البيانات المالية والمدفوعات</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <!-- Buttons to trigger the modals -->
                     <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                         data-target="#invoiceModal">
                         إضافة فاتورة
                     </button>
                     <button type="button" class="btn btn-success mb-2" data-toggle="modal"
                         data-target="#receiptModal">
                         إضافة سند قبض
                     </button>
                     <button type="button" class="btn btn-warning mb-2" data-toggle="modal"
                         data-target="#paymentVoucherModal">
                         إضافة سند صرف
                     </button>
                 </div>
                 <div class="modal-footer">
                 </div>
             </div>
         </div>
     </div>

     <!-- Modal for Adding Invoice -->
     <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="invoiceModalLabel">إضافة فاتورة</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <!-- Form for adding an invoice -->
                     <form>
                         <div class="form-group">
                             <label for="invoice_number">رقم الفاتورة</label>
                             <input type="text" class="form-control" id="invoice_number"
                                 placeholder="أدخل رقم الفاتورة">
                         </div>
                         <div class="form-group">
                             <label for="invoice_amount">المبلغ</label>
                             <input type="number" class="form-control" id="invoice_amount" placeholder="أدخل المبلغ">
                         </div>
                         <div class="form-group">
                             <label for="invoice_date">تاريخ الفاتورة</label>
                             <input type="date" class="form-control" id="invoice_date">
                         </div>
                     </form>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                     <button type="button" class="btn btn-primary">حفظ الفاتورة</button>
                 </div>
             </div>
         </div>
     </div>

     <!-- Modal for Adding Receipt -->
     <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="receiptModalLabel">إضافة سند قبض</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <!-- Form for adding a receipt -->
                     <form>
                         <div class="form-group">
                             <label for="receipt_number">رقم سند القبض</label>
                             <input type="text" class="form-control" id="receipt_number"
                                 placeholder="أدخل رقم سند القبض">
                         </div>
                         <div class="form-group">
                             <label for="receipt_amount">المبلغ</label>
                             <input type="number" class="form-control" id="receipt_amount" placeholder="أدخل المبلغ">
                         </div>
                         <div class="form-group">
                             <label for="receipt_date">تاريخ سند القبض</label>
                             <input type="date" class="form-control" id="receipt_date">
                         </div>
                     </form>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                     <button type="button" class="btn btn-primary">حفظ سند القبض</button>
                 </div>
             </div>
         </div>
     </div>

     <!-- Modal for Adding Payment Voucher -->
     <div class="modal fade" id="paymentVoucherModal" tabindex="-1" role="dialog"
         aria-labelledby="paymentVoucherModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="paymentVoucherModalLabel">إضافة سند صرف</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <!-- Form for adding a payment voucher -->
                     <form>
                         <div class="form-group">
                             <label for="payment_voucher_number">رقم سند الصرف</label>
                             <input type="text" class="form-control" id="payment_voucher_number"
                                 placeholder="أدخل رقم سند الصرف">
                         </div>
                         <div class="form-group">
                             <label for="payment_voucher_amount">المبلغ</label>
                             <input type="number" class="form-control" id="payment_voucher_amount"
                                 placeholder="أدخل المبلغ">
                         </div>
                         <div class="form-group">
                             <label for="payment_voucher_date">تاريخ سند الصرف</label>
                             <input type="date" class="form-control" id="payment_voucher_date">
                         </div>
                     </form>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                     <button type="button" class="btn btn-primary">حفظ سند الصرف</button>
                 </div>
             </div>
         </div>
     </div> 
     --}}
