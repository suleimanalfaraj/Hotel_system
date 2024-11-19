@extends('backend.layout.admin')

@section('name-page')
    الإعدادات
@stop

@section('content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h4>إعدادات النظام</h4>
                </div>
                <div class="card-body text-center">
                    @if(isset($setting))
                    <p class="mb-3"><strong>اسم الفندق:</strong> {{ $setting->hotel_name }}</p>
                    <p class="mb-3"><strong>رقم الضريبة:</strong> {{ $setting->tax_number }}</p>
                    <p class="mb-3"><strong>رقم الشركة:</strong> {{ $setting->company_number }}</p>
                    <p class="mb-3"><strong>البريد الإلكتروني:</strong> {{ $setting->email }}</p>
                    <p class="mb-3"><strong>المدينة:</strong> {{ $setting->city }}</p>
                    <p class="mb-3"><strong>الشارع:</strong> {{ $setting->street }}</p>
                        <div class="d-flex justify-content-center mt-4">
                            <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-secondary mx-2">
                                <i class="fas fa-edit"></i> تعديل الإعدادات
                            </a>
                            <form action="{{ route('settings.destroy', $setting->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-2">
                                    <i class="fas fa-trash"></i> حذف الإعدادات
                                </button>
                            </form>
                        </div>
                    @else
                        <p>لا توجد إعدادات حتى الآن.</p>
                        <a href="{{ route('settings.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> إنشاء إعداد جديد
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
