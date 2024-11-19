@extends('backend.layout.admin')
@section('name-page')
create settings
@stop

@section('content')
<div class="container mt-5">
    <h4 class="text-center mb-4">إعدادات النظام - الإدارة الفندقية</h4>
    <form action="{{ route('settings.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="hotel_name" class="form-label">اسم الفندق</label>
                <input type="text" id="hotel_name" name="hotel_name" class="form-control" value="{{ $settings->hotel_name ?? '' }}" required>
            </div>
            <div class="col-md-6">
                <label for="tax_number" class="form-label">الرقم الضريبي</label>
                <input type="text" id="tax_number" name="tax_number" class="form-control" value="{{ $settings->tax_number ?? '' }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="company_number" class="form-label">رقم المؤسسة</label>
                <input type="text" id="company_number" name="company_number" class="form-control" value="{{ $settings->company_number ?? '' }}" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $settings->email ?? '' }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="city" class="form-label">اسم المدينة</label>
                <input type="text" id="city" name="city" class="form-control" value="{{ $settings->city ?? '' }}" required>
            </div>
            <div class="col-md-6">
                <label for="street" class="form-label">اسم الشارع</label>
                <input type="text" id="street" name="street" class="form-control" value="{{ $settings->street ?? '' }}" required>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
        </div>
    </form>
</div>

@endsection