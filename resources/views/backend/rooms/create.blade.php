@extends('backend.layout.admin')

 @section('name-page')
  Add Rooms 
 @stop


 @section('content')
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
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
                {{session('success')}}
        </div>
    @endif

        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="room_number">رقم الغرفة:</label>
                <input type="number" name="room_number" class="form-control" id="room_number" placeholder="أدخل رقم الغرفة" min="1" required>
            </div>

            <div class="form-group">
                <label for="room_type">نوع الغرفة:</label>
                <select class="form-control" id="room_type" name="room_type" required>
                    <option value="">اختر نوع الغرفة</option>
                    <option value="single">غرفة فردية</option>
                    <option value="double">غرفة مزدوجة</option>
                    <option value="suite">جناح</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">سعر الغرفة (بالعملة المحلية):</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="أدخل سعر الغرفة" min="0" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary">إضافة الغرفة</button>
        </form>


@endsection

{{--  --}}





 {{-- 
 <div class="container mt-5">
    <h2 class="text-center">إضافة غرفة جديدة</h2>
    <form action="{{route('rooms.store')}}" method="POST">
        @csrf <!-- حماية من CSRF -->
        <div class="form-group">
            <label for="room_number">رقم الغرفة</label>
            <input type="text" class="form-control" id="room_number" name="room_number" required>
        </div>
        <div class="form-group">
            <label for="room_type">نوع الغرفة</label>
            <select class="form-control" id="room_type" name="room_type" required>
                <option value="">اختر نوع الغرفة</option>
                <option value="single">غرفة فردية</option>
                <option value="double">غرفة مزدوجة</option>
                <option value="suite">جناح</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">سعر الغرفة</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary">إضافة غرفة</button>
    </form>
</div> 

--}}