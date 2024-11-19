 
@extends('backend.layout.admin')

@section('name-page')
التقارير
@stop


@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <a href="{{ route('financial.report')}}" class="btn btn-primary">
                        <i class="fas fa-chart-line fa-2x"></i><br>
                        التقرير المالي
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <a href="{{ route('room.report')}}" class="btn btn-secondary">
                        <i class="fas fa-bed fa-2x"></i><br>
                        تقرير الغرف
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <a href="{{route('reservation-report.report')}}" class="btn btn-success">
                        <i class="fas fa-calendar-check fa-2x"></i><br>
                        تقرير الحجوزات
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 

