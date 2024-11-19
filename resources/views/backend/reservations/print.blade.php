@extends('backend.layout.admin')

@section('name-page')
    طباعة الحجز
@stop


@section('content')
<div class="container">
    <h2 class="text-center mb-4">تفاصيل الحجز</h2>

    <table class="table table-bordered text-center">
        <tr>
            <th>رقم الحجز</th>
            <td>{{ $reservation->reservation_number }}</td>
        </tr>
        <tr>
            <th>الاسم</th>
            <td>{{ $reservation->name }}</td>
        </tr>
        <tr>
            <th>رقم الجوال</th>
            <td>{{ $reservation->phone }}</td>
        </tr>
        <tr>
            <th>الهوية الوطنية</th>
            <td>{{ $reservation->national_id }}</td>
        </tr>
        <tr>
            <th>الجنس</th>
            <td>{{ $reservation->gender }}</td>
        </tr>
        <tr>
            <th>الجنسية</th>
            <td>{{ $reservation->nationality }}</td>
        </tr>
        <tr>
            <th>تاريخ الوصول</th>
            <td>{{ $reservation->check_in }}</td>
        </tr>
        <tr>
            <th>تاريخ المغادرة</th>
            <td>{{ $reservation->check_out }}</td>
        </tr>
        <tr>
            <th>رقم الغرفة</th>
            <td>{{ $room->room_number }}</td>
        </tr>
    </table>

    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-success">
            <i class="fas fa-print"></i> طباعة
        </button>
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">رجوع</a>
    </div>
</div>
@endsection