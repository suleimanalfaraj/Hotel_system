@extends('backend.layout.admin')

@section('name-page')
    Add Invoices
@stop


@section('content')
<div class="container">
    <h2 class="mb-4">سندات القبض للحجز رقم </h2>

    <!-- رسالة نجاح العملية -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- زر لإضافة سند جديد -->
    <div class="mb-3">
        <a href="#" class="btn btn-primary">إضافة سند قبض جديد</a>
    </div>

    <!-- جدول عرض سندات القبض -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>رقم السند</th>
                <th>التاريخ</th>
                <th>الوقت</th>
                <th>طريقة الدفع</th>
                <th>المبلغ</th>
                <th>الغرض</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($receipts as $receipt)
                <tr>
                    <td>{{ $receipt->receipt_number }}</td>
                    <td>{{ $receipt->date }}</td>
                    <td>{{ $receipt->time }}</td>
                    <td>{{ $receipt->payment_method }}</td>
                    <td>{{ $receipt->amount }}</td>
                    <td>{{ $receipt->purpose }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">عرض</a>
                        <a href="#" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="#" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذا السند؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">لا توجد سندات قبض لهذا الحجز.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
