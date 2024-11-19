@extends('backend.layout.admin')

@section('name-page')
 Show Rooms 
@stop


@section('content')
<div class="container">
    <h3>تفاصيل الغرفة</h3>
    <div class="card">
        <div class="card-body">
            <p>رقم الغرفة: <strong>{{ $room->room_number }}</strong></p>
            <p>نوع الغرفة: <strong>{{ $room->room_type }}</strong></p>
            <p>سعر الغرفة: <strong>{{ $room->price }}</strong></p>
            <p>الوصف: <strong>{{ $room->description }}</strong></p>
            <a href="{{ url('/rooms') }}" class="btn btn-secondary">رجوع</a>
            <a href="{{ url('/rooms/' . $room->id . '/edit') }}" class="btn btn-warning">تعديل الغرفة</a>
        </div>
    </div>
</div>
@endsection