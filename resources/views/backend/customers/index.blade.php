 @extends('backend.layout.admin')

 @section('name-page')
     Customers
 @stop


 @section('content')

     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                            <a href="#"  type="button" class="btn btn-primary btn-sm">اضافة عميل</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead> 
                              <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Nationality</th>
                                <th>National ID</th>
                              </tr>
                            </thead>
                            <tbody> 
                                @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->name ?? 'N/A' }}</td>
                                    <td>{{ $reservation->phone ?? 'N/A' }}</td>
                                    <td>{{ $reservation->gender ?? 'N/A' }}</td>
                                    <td>{{ $reservation->nationality ?? 'N/A' }}</td>
                                    <td>{{ $reservation->national_id ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                     </div>
                 </div>
             </div>
     </section>


 @endsection


 {{-- <h1>Customer Reservations</h1>

 <table border="1">
     <thead>
         <tr>
             <th>Name</th>
             <th>Phone</th>
             <th>Gender</th>
             <th>Nationality</th>
             <th>National ID</th>
         </tr>
     </thead>
     <tbody>
         @foreach ($reservations as $reservation)
             <tr>
                 <td>{{ $reservation->name ?? 'N/A' }}</td>
                 <td>{{ $reservation->phone ?? 'N/A' }}</td>
                 <td>{{ $reservation->gender ?? 'N/A' }}</td>
                 <td>{{ $reservation->nationality ?? 'N/A' }}</td>
                 <td>{{ $reservation->national_id ?? 'N/A' }}</td>
             </tr>
         @endforeach
     </tbody>
 </table> --}}