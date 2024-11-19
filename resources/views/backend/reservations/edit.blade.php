@extends('backend.layout.admin')

@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h2 class="mb-4">تعديل الحجز</h2>

    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')
        

        <div class="form-group">
            <label for="name">الاسم</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $reservation->name }}" required>
        </div>

        <div class="form-group">
            <label for="phone">رقم الجوال</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $reservation->phone }}" required>
        </div>
        <div class="form-group">
            <label for="rental_type">نوع الإيجار</label>
            <select name="rental_type" id="rental_type" class="form-control" required>
                <option value="يومي" {{ $reservation->rental_type == 'يومي' ? 'selected' : '' }}>يومي</option>
                <option value="أسبوعي" {{ $reservation->rental_type == 'أسبوعي' ? 'selected' : '' }}>أسبوعي</option>
                <option value="شهري" {{ $reservation->rental_type == 'شهري' ? 'selected' : '' }}>شهري</option>
            </select>
        </div>

        <div class="form-group">
            <label for="national_id">الهوية الوطنية</label>
            <input type="text" name="national_id" id="national_id" class="form-control" value="{{ $reservation->national_id }}" required>
        </div>

        <div class="form-group">
            <label for="gender">الجنس</label>
            <select name="gender" id="gender" class="form-control">
                <option value="ذكر" {{ $reservation->gender == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                <option value="أنثى" {{ $reservation->gender == 'أنثى' ? 'selected' : '' }}>أنثى</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nationality">الجنسية</label>
            <input type="text" name="nationality" id="nationality" class="form-control" value="{{ $reservation->nationality }}" required>
        </div>

        <div class="form-group">
            <label for="check_in">تاريخ الوصول</label>
            <input type="date" name="check_in" id="check_in" class="form-control" value="{{ $reservation->check_in }}" required>
        </div>

        <div class="form-group">
            <label for="check_out">تاريخ المغادرة</label>
            <input type="date" name="check_out" id="check_out" class="form-control" value="{{ $reservation->check_out }}" required>
        </div>

        <div class="form-group">
            <label for="room_id">رقم الغرفة</label>
            <select name="room_id" id="room_id" class="form-control">
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ $reservation->room_id == $room->id ? 'selected' : '' }}>
                        {{ $room->room_number }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">الحالة</label>
            <select name="status" id="status" class="form-control">
                <option value="جديد" {{ $reservation->status == 'جديد' ? 'selected' : '' }}>جديد</option>
                <option value="مؤكد" {{ $reservation->status == 'مؤكد' ? 'selected' : '' }}>مؤكد</option>
                <option value="مكتمل" {{ $reservation->status == 'مكتمل' ? 'selected' : '' }}>مكتمل</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
