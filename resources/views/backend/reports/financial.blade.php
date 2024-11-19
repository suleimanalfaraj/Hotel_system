@extends('backend.layout.admin')

 @section('name-page')
    تقرير المالية
 @stop




 @section('content')
     <div class="container mt-5">
         <h3 class="text-center mb-4">التقرير المالي - الفواتير - السندات</h3>

         <form method="GET" action="{{ route('financial.report') }}">
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="start_date" class="form-label">تاريخ البداية</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-6">
                    <label for="end_date" class="form-label">تاريخ النهاية</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                </div>
            </div>
        
            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="payment_method" class="form-label">طريقة الدفع</label>
                    <select class="form-select" id="payment_method" name="payment_method">
                        <option value="">اختر طريقة الدفع</option>
                        <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>نقدًا</option>
                        <option value="credit_card" {{ request('payment_method') == 'credit_card' ? 'selected' : '' }}>بطاقة ائتمان</option>
                        <option value="bank_transfer" {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>تحويل بنكي</option>
                    </select>
                </div>
            </div>
        
            <button type="submit" class="btn btn-primary">عرض التقرير</button>
        </form>
        

         <!-- تحديد طرق الدفع -->
         <div class="row mb-4">
             <div class="col-md-12">
                 <label for="payment_method" class="form-label">طريقة الدفع</label>
                 <select class="form-select" id="payment_method" name="payment_method">
                     <option selected>اختر طريقة الدفع</option>
                     <option value="cash">نقدًا</option>
                     <option value="credit_card">بطاقة ائتمان</option>
                     <option value="bank_transfer">تحويل بنكي</option>
                 </select>
             </div>
         </div>

         <h4>الفواتير</h4>
         <div class="table-responsive">
             <table class="table table-bordered table-striped">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>رقم الفاتورة</th>
                         <th>التاريخ</th>
                         <th>المبلغ</th>
                         <th>ملاحظات</th>

                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($invoices as $invoice)
                         <tr>
                             <td>{{ $loop->iteration }}</td>
                             <td>{{ $invoice->invoice_number }}</td>
                             <td>{{ $invoice->invoice_Date }}</td>
                             <td>{{ $invoice->Total }}</td>
                             <td>{{ $invoice->note }}</td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>

         <h4>سندات القبض</h4>
         <div class="table-responsive">
             <table class="table table-bordered table-striped">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>رقم السند</th>
                         <th>التاريخ</th>
                         <th>طريقة الدفع</th>
                         <th>المبلغ</th>
                         <th>الوصف</th>

                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($receipts as $receipt)
                         <tr>
                             <td>{{ $loop->iteration }}</td>
                             <td>{{ $receipt->receipt_number }}</td>
                             <td>{{ $receipt->date }}</td>
                             <td>{{ $receipt->payment_method }}</td>
                             <td>{{ $receipt->amount }}</td>
                             <td>{{ $receipt->description }}</td>

                         </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>




     </div>
 @endsection
