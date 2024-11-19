<?php


use App\Http\Controllers\Backend;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () { return view('welcome'); });

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

        /* dashboard admin and user route */
        Route::get('/admin/dashboard', [Frontend\AdminController::class, 'index'])->name('admin.dashboard')->middleware('admin');
        Route::get('/user/dashboard', [Frontend\UserController::class, 'index'])->name('user.dashboard');


        /* reservations route الحجوزات*/
        Route::resource('/reservations', backend\ReservationsController::class);
        Route::get('reservations/{id}/print', [backend\ReservationsController::class, 'print'])->name('reservations.print');


        /* invoices route الفواتير*/
        Route::resource('/invoices', backend\InvoicesController::class);


        /* receipts route السندات */
        Route::get('receipts', [backend\ReceiptController::class, 'index'])->name('receipts.index');
        Route::post('receipts/store', [backend\ReceiptController::class, 'store'])->name('receipts.store');
        

         /* payment-vouchers route السندات */
        Route::resource('payment-vouchers', backend\PaymentVoucherController::class);

        /* reports route التقارير*/
        Route::resource('/reports', backend\ReportsController::class);
        Route::get('/financial-report', [backend\ReportsController::class, 'financial'])->name('financial.report');
        Route::get('/room-report', [backend\ReportsController::class, 'room_report'])->name('room.report');
        Route::get('/room-report/download', [backend\ReportsController::class, 'download'])->name('room.report.download');
        Route::get('/reservation-report', [backend\ReportsController::class, 'reservationReport'])->name('reservation-report.report');


        /* rooms route الغرف*/
        Route::resource('/rooms', backend\RoomsController::class);

        /* settings route */
        Route::resource('settings', backend\SettingController::class);

        /* customers route */
        Route::get('/customers', [backend\CustomerControllers::class, 'index'])->name('customers.index');

});













