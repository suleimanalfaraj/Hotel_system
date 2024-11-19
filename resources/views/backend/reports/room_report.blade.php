@extends('backend.layout.admin')

@section('name-page')
    تقرير الغرف
@stop

@section('content')
    <style>
        @media print {

            .btn-info {
                display: none;
            }

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
        <!-- Filter Section -->
        <form method="GET" action="#" class="mb-4">
            <label for="filter_date" class="form-label">تصفية حسب التاريخ:</label>
            <div class="d-flex align-items-center gap-2">
                <input 
                    type="date" 
                    name="filter_date" 
                    id="filter_date" 
                    class="form-control w-auto"
                    value="{{ $filter_date }}">
                <button type="submit" class="btn btn-primary">بحث</button>
            </div>
        </form>

        <!-- Report Header -->
        <div class="text-center mb-4">
            <h4 class="mb-4">   إحصائيات تأجير الشقق</h4>

                <!-- Print and Actions Section -->
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <button type="button" class="btn btn-primary ms-2"><i class="fas fa-download"></i>تنزيل تقرير الغرف </button>
                    <button  onclick="window.print()" class="btn btn-primary  ms-2"><i class="fas fa-print"></i>طباعة تقرير الغرف</button>
                </div>
            </div>
        </div>
        </div>

        <!-- Rooms Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>رقم الغرفة</th>
                        <th>نوع الغرفة</th>
                        <th>الحالة</th>
                        <th>السعر</th>
                        <th>الفواتير</th>
                        <th>الحجز</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->room_type }}</td>
                            <td>{{ $room->status }}</td>
                            <td>{{ $room->price }}</td>
                            <td>
                                @forelse ($room->invoices as $invoice)
                                    <div>فاتورة: ${{ $invoice->Total }}</div>
                                @empty
                                    <div>لا توجد فواتير</div>
                                @endforelse
                            </td>
                            <td>
                                @if ($room->reservation)
                                    <div>محجوز بواسطة: {{ $room->reservation->name }}</div>
                                    <div>التواريخ: {{ $room->reservation->check_in }} - {{ $room->reservation->check_out }}</div>
                                    <div>رقم الهاتف: {{ $room->reservation->phone }}</div>
                                    <div>الجنسية: {{ $room->reservation->nationality }}</div>
                                @else
                                    <div>غير محجوزة</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        <!-- Statistics Section -->
        <div class="mt-5">
            <h4 class="mb-4 text-center">إحصائيات الحجوزات اليومية والشهرية</h4>

<!-- Daily Reservations -->
<h5 class="mt-4 text-center">الحجوزات اليومية</h5>
<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead class="table-primary">
            <tr>
                <th style="width: 50%;">التاريخ</th>
                <th style="width: 50%;">عدد الحجوزات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daily_reservations as $reservation)
                <tr class="{{ $loop->odd ? 'table-light' : '' }}">
                    <td>
                        <i class="fas fa-calendar-alt text-info me-1"></i>
                        {{ $reservation->date }}
                    </td>
                    <td>
                        <i class="fas fa-chart-line text-success me-1"></i>
                        {{ $reservation->count }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Monthly Reservations -->
<h5 class="mt-4 text-center">الحجوزات الشهرية</h5>
<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead class="table-warning">
            <tr>
                <th style="width: 50%;">الشهر / السنة</th>
                <th style="width: 50%;">عدد الحجوزات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($monthly_reservations as $reservation)
                <tr class="{{ $loop->odd ? 'table-light' : '' }}">
                    <td>
                        <i class="fas fa-calendar text-warning me-1"></i>
                        {{ $reservation->month }} / {{ $reservation->year }}
                    </td>
                    <td>
                        <i class="fas fa-chart-bar text-primary me-1"></i>
                        {{ $reservation->count }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

        </div>
    </div>


@endsection

