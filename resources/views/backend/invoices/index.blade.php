@extends('backend.layout.admin')

 @section('name-page')
     Invoices
 @stop


 @section('content')


 @if(session('success'))
 <div class="alert alert-success">
     {{ session('success') }}
 </div>
@endif


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


            <div class="card">
              <div class="card-header">
                <a href="{{route('invoices.create')}}"  type="button" class="btn btn-primary btn-sm">اضافة فاتورة </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead> 
                    <tr>
                      <th> رقم الفاتورة</th>
                      <th>رقم الحجز</th>
                      <th>رقم الغرفة</th>
                      <th>تاريخ الانشاء</th>
                      <th>المجموع</th>
                     
                      <th>العمليات</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                      <td>{{ $invoice->invoice_number }}</td>
                      <td>{{ $invoice->reservation->reservation_number ?? 'N/A' }}</td>
                      <td>{{ $invoice->room->room_number ?? 'N/A' }}</td>
                      <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                      <td>{{ $invoice->Total }}</td>
               
                      <td>
                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->



 @endsection
