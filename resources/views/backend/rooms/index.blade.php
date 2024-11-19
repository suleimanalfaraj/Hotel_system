@extends('backend.layout.admin')
@section('name-page')
    Rooms
@stop


@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a class="btn btn-primary" href="{{ url('/rooms/create') }}">إضافة غرفة</a>
    <br><br>
    <div class="row">
        @foreach ($rooms as $info)
            <div class="col-md-3 mb-4">
                <div class="card p-2">
                    <p class="card-title">رقم الغرفة: <strong>{{ $info->room_number }}</strong></p>
                    <p class="card-text">نوع الغرفة: <strong>{{ $info->room_type }}</strong></p>
                    <p class="card-text">سعر الغرفة: <strong>{{ $info->price }}</strong></p>
                    <a href="{{ url('/rooms/' . $info->id) }}" class="btn btn-sm btn-success mt-2">عرض التفاصيل</a>
                    <a href="{{ url('/rooms/' . $info->id . '/edit') }}" class="btn btn-sm btn-warning mt-2">تعديل الغرفة</a>
                </div>
            </div>
        @endforeach
    </div>
    
@endsection



{{-- 
    <div class="col-sm-4">
        <div class="card">
        <div class="card-body">
            <p class="card-title">رقم الغرفة: </strong>{{$info->room_number}}</p>
            <p class="card-text"> نوع الغرفة: </strong>{{$info->room_type}}</p>
            <p class="card-text"> سعر الغرفة: </strong> {{$info->price}}</p>
        </div>
        </div>
    </div> --}}
