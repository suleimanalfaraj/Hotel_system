@extends('backend.layout.admin')

@section('name-page')
    Edit Invioices
@stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">تعديل الفاتورة</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('invoices.update', $invoices->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label>رقم الفاتورة</label>
                                <input type="text" name="invoice_number" class="form-control" value="{{ $invoices->invoice_number }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>تاريخ الفاتورة</label>
                                <input type="date" name="invoice_Date" class="form-control" value="{{ $invoices->invoice_Date }}">
                            </div>

                            <div class="form-group">
                                <label>تاريخ الاستحقاق</label>
                                <input type="date" name="Due_date" class="form-control" value="{{ $invoices->Due_date }}">
                            </div>

                            <div class="form-group">
                                <label>المبلغ المحصل</label>
                                <input type="number" name="Amount_collection" class="form-control" value="{{ $invoices->Amount_collection }}">
                            </div>

                            <div class="form-group">
                                <label>العمولة</label>
                                <input type="number" name="Amount_Commission" class="form-control" value="{{ $invoices->Amount_Commission }}">
                            </div>

                            <div class="form-group">
                                <label>الخصم</label>
                                <input type="number" name="Discount" class="form-control" value="{{ $invoices->Discount }}">
                            </div>

                            <div class="form-group">
                                <label>قيمة الضريبة</label>
                                <input type="number" name="Value_VAT" class="form-control" value="{{ $invoices->Value_VAT }}">
                            </div>

                            <div class="form-group">
                                <label>المجموع</label>
                                <input type="number" name="Total" class="form-control" value="{{ $invoices->Total }}" readonly>
                            </div>

                            <div class="form-group">
                                <label>ملاحظات</label>
                                <textarea name="note" class="form-control">{{ $invoices->note }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>الحالة</label>
                                <select name="Status" class="form-control">
                                    <option value="مدفوعة" {{ $invoices->Status == 'مدفوعة' ? 'selected' : '' }}>مدفوعة</option>
                                    <option value="غير مدفوعة" {{ $invoices->Status == 'غير مدفوعة' ? 'selected' : '' }}>غير مدفوعة</option>
                                    <option value="متأخرة" {{ $invoices->Status == 'متأخرة' ? 'selected' : '' }}>متأخرة</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">تحديث الفاتورة</button>
                                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">إلغاء</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection