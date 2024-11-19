@extends('backend.layout.admin')

@section('name-page')
 edit Rooms 
@stop


@section('content')
<div class="container">
    <h3>تعديل بيانات الغرفة</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/rooms/' . $room->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- رقم الغرفة -->
                <div class="mb-3">
                    <label for="room_number" class="form-label">رقم الغرفة</label>
                    <input type="text" name="room_number" id="room_number" class="form-control" value="{{ $room->room_number }}" required>
                </div>

                <!-- نوع الغرفة -->
                <div class="mb-3">
                    <label for="room_type" class="form-label">نوع الغرفة</label>
                    <input type="text" name="room_type" id="room_type" class="form-control" value="{{ $room->room_type }}" required>
                </div>

                <!-- سعر الغرفة -->
                <div class="mb-3">
                    <label for="price" class="form-label">سعر الغرفة</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ $room->price }}" step="0.01" required>
                </div>

                <!-- وصف الغرفة -->
                <div class="mb-3">
                    <label for="description" class="form-label">وصف الغرفة</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ $room->description }}</textarea>
                </div>

                <!-- أزرار الحفظ والإلغاء -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                    <a href="{{ url('/rooms') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection