@extends('backend.layout.admin')

@section('name-page')
    الحجوزات
@stop

@section('content')

    <style>
        .card {
            width: 200px;
            height: 200px;
            padding: 10px;
            font-size: 0.9rem;
            overflow-y: auto;
            background-color: #ffffff;
            color: #000;
            border: 1px solid #ddd;
            position: relative;
            transition: opacity 0.3s ease-in-out;
        }

        .card-title {
            font-size: 1rem;
        }

        .btn {
            padding: 5px 10px;
            font-size: 0.8rem;
        }

        .card-text {
            white-space: normal;
        }

        .row {
            margin: 0;
        }

        .col {
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .bed-icon {
            font-size: 2rem;
            margin-top: auto;
        }

        .available-icon {
            color: green;
        }

        .occupied-icon {
            color: red;
        }

        .edit-icon {
            font-size: 2rem;
            color: #002d5d;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
        }

        .card.occupied:hover .edit-icon {
            display: block;
        }

        .card:hover {
            opacity: 0.5;
        }

        .card .bed-icon,
        .card .edit-icon {
            z-index: 1;
        }
    </style>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="container my-4">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <button class="btn btn-primary" onclick="filterApartments('all')">عرض الكل</button>
                    <button class="btn btn-success" onclick="filterApartments('available')">الشقق الشاغرة</button>
                    <button class="btn btn-danger" onclick="filterApartments('occupied')">الشقق المؤجرة</button>
                </div>
                <button class="btn btn-secondary">تصفية</button>
            </div>


            <div class="row row-cols-1 row-cols-md-3 g-0" id="apartments-container">
                @foreach ($rooms as $room)
                    @php
                        $reservation = $room->reservation;
                    @endphp
                    <div class="col apartment {{ $reservation ? 'occupied' : ($room->is_cleaning ? 'cleaning' : 'available') }}">
                        <div class="card h-100 shadow-sm {{ $reservation ? 'occupied' : '' }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate">رقم الغرفة: {{ $room->room_number }}</h5>
                                @if ($reservation)
                                    <p class="card-text">اسم العميل: {{ $reservation->name }}</p>
                                    <p class="card-text">
                                        المبلغ المدفوع:
                                        <span class="text-success">{{ $reservation->receipts->sum('amount') ?? 0 }} </span>
                                    </p>
                                    <p class="card-text">
                                        المبلغ المتبقي:
                                        <span class="text-danger">{{ $reservation->remaining_amount ?? 0 }} </span>
                                    </p>

                                    <i class="fas fa-bed bed-icon occupied-icon"></i>
                                    <a href="{{ route('reservations.edit', $reservation->id) }}" class="edit-icon">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('reservations.show', $reservation->id) }}"
                                        class="btn btn-primary btn-sm mt-auto">عرض التفاصيل</a>
                                @elseif ($room->is_cleaning)
                                    <p class="card-text">الغرفة تحت التنظيف</p>
                                    <i class="fas fa-broom cleaning-icon"></i>
                                @else
                                    <p class="card-text">الغرفة متاحة</p>
                                    <a href="{{ route('reservations.create', ['room_id' => $room->id]) }}"
                                        class="btn btn-success mt-auto">حجز الغرفة</a>
                                    <i class="fas fa-bed bed-icon available-icon"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
    </div>

    <script>
        function filterApartments(filter) {
            let apartments = document.querySelectorAll('.apartment');
            apartments.forEach(apartment => {
                if (filter === 'all' || apartment.classList.contains(filter)) {
                    apartment.style.display = '';
                } else {
                    apartment.style.display = 'none';
                }
            });
        }
    </script>

@endsection




{{-- 
            <!-- عرض الغرف مع الحجوزات -->
            <div class="row row-cols-1 row-cols-md-3 g-4 "> <!-- باستخدام g-4 لتحديد المسافات بين البطاقات -->
                @foreach ($rooms as $room)
                    @foreach ($reservations->where('room_id', $room->id) as $reservation)
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-truncate">رقم الغرفة: {{$room->room_number}}</h5> <!-- إضافة text-truncate للتأكد من عدم تجاوز النص -->
                                    <p class="card-text text-truncate">اسم العميل: {{$reservation->name}}</p> <!-- إضافة text-truncate للنصوص الطويلة -->
                                    <p class="card-text">
                                        حالة الغرفة: 
                                        <span class="{{ $reservation->status == 'شاغرة' ? 'text-success' : 'text-danger' }}">
                                            {{$reservation->status}}
                                        </span>
                                    </p>
                                    <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-primary btn-sm mt-auto">عرض التفاصيل</a> <!-- إضافة mt-auto لجعل الزر في أسفل البطاقة -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div> 
--}}

{{-- 
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>رقم الحجز</th>
                        <th>الاسم</th>
                        <th>رقم الجوال</th>
                        <th>الهوية الوطنية</th>
                        <th>الجنس</th>
                        <th>الجنسية</th>
                        <th>تاريخ الوصول</th>
                        <th>تاريخ المغادرة</th>
                        <th>رقم الغرفة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr>
                        <td><a href="{{ route('reservations.show', $reservation->id) }}">{{ $reservation->reservation_number }}</a></td> <!-- رابط لعرض التفاصيل -->
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->phone }}</td>
                        <td>{{ $reservation->national_id }}</td>
                        <td>{{ $reservation->gender }}</td>
                        <td>{{ $reservation->nationality }}</td>
                        <td>{{ $reservation->check_in }}</td>
                        <td>{{ $reservation->check_out }}</td>
                        <td>{{ $reservation->room_id }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> تعديل</button>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> حذف</button>
                            <button class="btn btn-info btn-sm"><i class="fas fa-print"></i> طباعة</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
            
        --}}

{{-- <div class="container mt-4">

            <div class="row">
                <!-- زر الشقق المتاحة -->
                <div class="col-md-6 mb-3">
                    <a href="#" class="btn btn-success btn-block">
                        <i class="fas fa-bed"></i> الشقق المتاحة
                    </a>
                </div>
                
                <!-- زر الشقق الشاغرة -->
                <div class="col-md-6 mb-3">
                    <a href="{{ route('rooms.create') }}" class="btn btn-danger btn-block">
                        <i class="fas fa-bed"></i> الشقق الشاغرة
                    </a>
                </div>
            </div>
        </div>

        <div class="row">  
        
            @foreach ($rooms as $room)   @foreach ($reservations as $reservation)
                
            <div class="col-sm-4">
                <div class="card">
                <div class="card-body">
                    <p class="card-title">رقم الغرفة: </strong> {{$room->room_number}}</p>
            
                
                    <p class="card-text">اسم العميل: </strong> {{$reservation->name}}</p>
                    <a href="{{ route('reservations.show', $reservation->id) }}">Show</a>
                </div>
                </div>
            </div>

            @endforeach      @endforeach
        </div>  --}}

{{-- //* ================================================================ *// --}}


{{-- =============================================== --}}
{{-- الازرار العلوية --}}
{{-- <div class="container my-4">
            <!-- الأزرار العلوية -->
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <button class="btn btn-primary" onclick="filterApartments('all')">عرض الكل</button>
                    <button class="btn btn-success" onclick="filterApartments('available')">الشقق الشاغرة</button>
                    <button class="btn btn-danger" onclick="filterApartments('occupied')">الشقق المؤجرة</button>
                </div>
                <button class="btn btn-secondary">تصفية</button>
        </div> --}}
{{-- /الازرار العلوية --}}


{{-- رو الغرف --}}
{{-- <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($rooms as $room)
                @php
                    $reservation = $reservations->where('room_id', $room->id)->first();
                @endphp
                <div class="col">
                    <div class="card h-100 shadow-sm {{ $reservation ? 'bg-danger text-white' : '' }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate">رقم الغرفة: {{$room->room_number}}</h5>
                            @if ($reservation)
                                <p class="card-text text-truncate">اسم العميل: {{$reservation->name}}</p>
                                <p class="card-text">حالة الغرفة: <span class="text-warning">{{$reservation->status}}</span></p>
                            @else
                                <p class="card-text text-truncate">الغرفة متاحة</p>
                                <a href="{{ route('reservations.create', ['room_id' => $room->id]) }}" class="btn btn-success mt-auto">حجز الغرفة</a>
                            @endif
                            @if ($reservation)
                                <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-primary btn-sm mt-auto">عرض التفاصيل</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
{{-- /رو الغرف --}}
