@extends('backend.layout.admin')

@section('name-page')
    تقرير الحجوزات
@stop


@section('content')
    <style>
        @media print {

            /* Hide the print button when printing */
            .btn-info {
                display: none;
            }

            /* You can adjust styles for the table if needed */
            table {
                width: 100%;
                border-collapse: collapse;
            }

            table th,
            table td {
                padding: 8px;
                text-align: center;
            }
        }
    </style>
    <div class="container mt-5">
        <h3 class="text-center mb-4">تقرير الحجوزات</h3>

        <!-- تحديد التاريخ -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="start_date" class="form-label">تاريخ البداية</label>
                <input type="date" class="form-control" id="start_date" name="start_date">
            </div>
            <div class="col-md-6">
                <label for="end_date" class="form-label">تاريخ النهاية</label>
                <input type="date" class="form-control" id="end_date" name="end_date">
            </div>
        </div>

        <!-- جدول الحجوزات -->
        <h4>تفاصيل الحجوزات</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الحجز</th>
                        <th>تاريخ انشاء الحجز</th>
                        <th>اسم العميل</th>
                        <th>الغرفة</th>
                        <th>تاريخ الوصول</th>
                        <th>تاريخ المغادرة</th>
                        <th>المبلغ المدفوع</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $reservation->reservation_number }}</td>
                            <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
                            <td>{{ $reservation->name }}</td>
                            <td>{{ $reservation->room->number }}</td>
                            <td>{{ $reservation->check_in }}</td>
                            <td>{{ $reservation->check_out }}</td>
                            <td>{{ $reservation->receipts->sum('amount') ?? 0 }}</td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

@endsection
