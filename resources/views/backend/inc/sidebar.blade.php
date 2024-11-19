<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/reservations') }}" class="brand-link">
        <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ \App\Models\Setting::first()->hotel_name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">


                <!-- Reservations Section -->
                <li class="nav-item text-center">
                    <a href="{{ url('/reservations') }}" class="nav-link">
                        <i class='bx bx-bed'></i> <!-- Bed Icon for Reservations -->
                        <h6>الحجوزات</h6>
                    </a>
                </li>


                <li class="nav-item text-center">
                    <a href="{{ url('/invoices') }}" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"></i> <!-- Invoice Icon -->
                        <h6> الفواتير</h6>
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a href="{{ url('receipts') }}" class="nav-link">
                        <i class="fas fa-file-signature nav-icon"></i> <!-- Receipt Icon -->
                        <h6>سندات القبض</h6>
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a href="{{ url('payment-vouchers') }}" class="nav-link">
                        <i class="fas fa-money-check-alt nav-icon"></i> <!-- Payment Icon -->
                        <h6>سندات الصرف</h6>
                    </a>
                </li>


                <!-- Rooms Section -->
                <li class="nav-item text-center">
                    <a href="{{ url('/customers') }}" class="nav-link">
                        <i class="fas fa-address-book nav-icon"></i> <!-- Room Icon -->
                        <h6>العملاء</h6>
                    </a>
                </li>


                <!-- Rooms Section -->
                <li class="nav-item text-center">
                    <a href="{{ url('/rooms') }}" class="nav-link">
                        <i class="fa-solid fa-door-open"></i> <!-- Room Icon -->
                        <h6>الغرف</h6>
                    </a>
                </li>

                <!-- Reports Section -->
                <li class="nav-item text-center">
                    <a href="{{ url('/reports') }}" class="nav-link">
                        <i class="fa-solid fa-house"></i><!-- Reports Icon -->
                        <h6>التقارير</h6>
                    </a>
                </li>

                <!-- Settings Section -->
                <li class="nav-item text-center">
                    <a href="{{ url('settings') }}" class="nav-link">
                        <i class="fa-solid fa-gear"></i><!-- Settings Icon -->
                        <h6>اعدادت النظام</h6>
                    </a>
                </li>


            </ul>
        </nav>



        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

@section('js')
    <script>
        $('.nav-item.has-treeview > a').on('click', function() {
            var icon = $(this).find('.fas.fa-angle-left'); // السهم
            if (icon.hasClass('fa-angle-left')) {
                icon.removeClass('fa-angle-left').addClass('fa-angle-down'); // تغيير السهم
            } else {
                icon.removeClass('fa-angle-down').addClass('fa-angle-left'); // إعادة السهم
            }
        });
    </script>
@endsection


