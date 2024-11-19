<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{

    public function index()
    {
        // $reservations = Reservation::all()->map(function ($reservations) {
        //     $reservations->is_available = $reservations->status === 'متاحة'; // إذا كانت متاحة ستكون القيمة true
        //     return $reservations;
        // });

        $reservations = Reservation::all();
        // جلب جميع الغرف مع حالة الحجز وعلامة التنظيف
        $rooms = Room::with('reservation')->get();
        return view('backend.reservations.index', compact('reservations', 'rooms'));
    }

    public function create(Request $request)
    {
        
    
        // توليد الرقم التسلسلي بناءً على آخر رقم حجز
        $lastReservation = Reservation::latest('id')->first();
        if ($lastReservation) {
            $lastNumber = (int)substr($lastReservation->reservation_number, 4);
            $newReservationNumber = 'RES-' . str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $newReservationNumber = 'RES-00001';
        }

        // التحقق من تمرير `room_id`
        $roomId = $request->input('room_id');

        // جلب الغرف المتاحة بناءً على `room_id` إذا تم تمريره
        $rooms = Room::doesntHave('reservation')->when($roomId, function ($query) use ($roomId) {
            return $query->where('id', $roomId);
        })->select('id', 'room_number', 'price')->get();

        // إذا لم تكن هناك غرف متاحة
        if ($rooms->isEmpty()) {
            return redirect()->route('backend.reservations.index')->withErrors(['error' => 'لا توجد غرف متاحة أو الغرفة المحجوزة غير متاحة']);
        }
        
        // عرض صفحة إنشاء الحجز مع المتغيرات المطلوبة
        return view('backend.reservations.create', compact('rooms', 'newReservationNumber', 'roomId'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_number' => 'required|string|max:255',
            'rental_type' => 'required|string|in:يومي,أسبوعي,شهري',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'room_id' => 'required|exists:rooms,id',
            'status' => 'required|string|in:جديد,مؤكد,مكتمل',
            'name' => 'required|string|max:255',
            'phone' => 'required|min:10|max:10',
            'gender' => 'required|string|in:ذكر,أنثى',
            'nationality' => 'required|string|max:255',
            'national_id' => 'required|string|min:10|max:10',
        ]);

        // توليد الرقم التسلسلي بناءً على آخر رقم حجز
        $lastReservation = Reservation::latest('id')->first();
        $newReservationNumber = $lastReservation
            ? 'RES-' . str_pad((int)substr($lastReservation->reservation_number, 4) + 1, 5, '0', STR_PAD_LEFT)
            : 'RES-00001';

        // إنشاء الحجز
        $reservation = new Reservation();
        $reservation->reservation_number = $newReservationNumber;
        $reservation->name = $request->name;
        $reservation->phone = $request->phone;
        $reservation->national_id = $request->national_id;
        $reservation->gender = $request->gender;
        $reservation->nationality = $request->nationality;
        $reservation->check_in = $request->check_in;
        $reservation->check_out = $request->check_out;
        $reservation->room_id = $request->room_id;
        $reservation->rental_type = $request->rental_type;
        $reservation->status = $request->status;

        // حساب المبلغ المتبقي بناءً على مدة الحجز
        $room = $reservation->room; // الحصول على الغرفة المرتبطة
        $pricePerDay = $room->price; // نفترض أن هناك حقل price لكل غرفة
        $checkInDate = new \Carbon\Carbon($reservation->check_in);
        $checkOutDate = new \Carbon\Carbon($reservation->check_out);
        $daysDifference = $checkInDate->diffInDays($checkOutDate);

        // إذا كانت مدة الحجز يوم واحد
        if ($daysDifference == 1) {
            // حدد المبلغ المتبقي بناءً على السعر اليومي
            $remainingAmount = $pricePerDay;
        } else {
            // إذا كانت مدة الحجز أكثر من يوم، يمكن حساب المبلغ المتبقي بناءً على إجمالي المدة
            $remainingAmount = $pricePerDay * $daysDifference;
        }

        // تحديث الحجز بالمبلغ المتبقي
        $reservation->remaining_amount = $remainingAmount;

        $reservation->save();

        // إرجاع المستخدم مع رسالة نجاح
        return redirect()->route('reservations.index')->with('success', 'تم إنشاء الحجز بنجاح');
    }


    public function show($reservationId)
    {
        $reservations = Reservation::findOrFail($reservationId);
        $room = Room::findOrFail($reservations->room_id);

        // توليد رقم الفاتورة تلقائيًا
        $lastInvoice = Invoice::latest('id')->first();
        $newInvoiceNumber = 'INV-' . str_pad(($lastInvoice ? $lastInvoice->id + 1 : 1), 5, '0', STR_PAD_LEFT);

        return view('backend.reservations.show', compact('reservations', 'room', 'newInvoiceNumber'));
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $rooms = Room::all(); // تأكد أن هذه الدالة تعمل وترجع قائمة بالغرف

        return view('backend.reservations.edit', compact('reservation', 'rooms'));
    }
    


    public function update(Request $request, $reservationId)
    {
        $validated = $request->validate([
            'rental_type' => 'required|string|in:يومي,أسبوعي,شهري',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'room_id' => 'required|exists:rooms,id',
            'status' => 'required|string|in:جديد,مؤكد,مكتمل',
            'name' => 'required|string|max:255',
            'phone' => 'required|min:10|max:10',
            'gender' => 'required|string|in:ذكر,أنثى',
            'nationality' => 'required|string|max:255',
            'national_id' => 'required|string|min:10|max:10',
        ]);

        $reservation = Reservation::findOrFail($reservationId);
        $reservation->update($validated);

        // تحديث المبلغ المتبقي بناءً على التواريخ الجديدة
        $room = $reservation->room;
        $pricePerDay = $room->price;
        $checkInDate = new \Carbon\Carbon($reservation->check_in);
        $checkOutDate = new \Carbon\Carbon($reservation->check_out);
        $daysDifference = $checkInDate->diffInDays($checkOutDate);
        $remainingAmount = $pricePerDay * $daysDifference;

        $reservation->remaining_amount = $remainingAmount;
        $reservation->save();
        // dd($reservation);
        return redirect()->route('reservations.index')->with('success', 'تم تحديث الحجز بنجاح');
    }


    public function destroy($id)
    {
        // $category = Category::findOrFail($id);
        // $category->delete();

        // // Category::where('id','=',$id)->delete();

        // // Category::destroy($id);

        // return Redirect::route('backend.categories.index');
    }

    public function print($id)
    {
        $reservation = Reservation::findOrFail($id);
        $room = Room::findOrFail($reservation->room_id);

        return view('backend.reservations.print', compact('reservation', 'room'));
    }
}




    // public function update(Request $request, reservation $reservation)
    // {
    //     // $category = Category::find($id);
    //     // $category->update($request->all());

    //     // return redirect()->route('dashboard.categories.index')
    //     // ->with('success','update success');
    // }



    // public function edit(reservation $reservation)
    // {
    //     //هذا الكود يعطي رسالة خطأ في حال بحث عن ايدي غير موجود 
    //     //     try{
    //     //         $category = Category::findOrFail($id);
    //     //     } catch(Exception $e){
    //     //         return redirect()->route('dashboard.categories.index')->with('info','not found');
    //     //         // abort(4040);
    //     //     }

    //     //     // SELECT * FROM categories WHERE id <> $id AND parent_id = $id  
    //     //     $parents = Category::where('id', '<>', $id)
    //     //     ->where(function($query) use($id){
    //     //         $query->whereNull('parent_id')
    //     //         ->orWhere('parent_id', '<>', $id);
    //     //     })
    //     //    ->get();

    //     //    return view('dashboard.categories.edit', compact('category','parents'));
    // }


    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'reservation_number' => 'required|string|max:255',
    //         'rental_type' => 'required|string|in:يومي,أسبوعي,شهري',
    //         'check_in' => 'required|date|after_or_equal:today',
    //         'check_out' => 'required|date|after:check_in',
    //         'room_id' => 'required|exists:rooms,id',
    //         'status' => 'required|string|in:جديد,مؤكد,مكتمل',
    //         'name' => 'required|string|max:255',
    //         'phone' => 'required|min:10|max:10',
    //         'gender' => 'required|string|in:ذكر,أنثى',
    //         'nationality' => 'required|string|max:255',
    //         'national_id' => 'required|string|min:10|max:10',
    //     ]);

    //     // توليد الرقم التسلسلي بناءً على آخر رقم حجز
    //     $lastReservation = Reservation::latest('id')->first();
    //     $newReservationNumber = $lastReservation
    //         ? 'RES-' . str_pad((int)substr($lastReservation->reservation_number, 4) + 1, 5, '0', STR_PAD_LEFT)
    //         : 'RES-00001';

    //     // إنشاء الحجز
    //     $reservation = new Reservation();
    //     $reservation->reservation_number = $newReservationNumber;
    //     $reservation->name = $request->name;
    //     $reservation->phone = $request->phone;
    //     $reservation->national_id = $request->national_id;
    //     $reservation->gender = $request->gender;
    //     $reservation->nationality = $request->nationality;
    //     $reservation->check_in = $request->check_in;
    //     $reservation->check_out = $request->check_out;
    //     $reservation->room_id = $request->room_id;
    //     $reservation->rental_type = $request->rental_type;
    //     $reservation->status = $request->status;
    //     $reservation->save();

    //     // إرجاع المستخدم مع رسالة نجاح
    //     return redirect()->route('reservations.index')->with('success', 'تم إنشاء الحجز بنجاح');
    // }

    // public function createInvoice($reservationId)
    // {
    //     $reservation = Reservation::findOrFail($reservationId);
    //     $room = Room::findOrFail($reservation->room_id);

    //     // توليد رقم الفاتورة تلقائيًا
    //     $lastInvoice = Invoice::latest('id')->first();
    //     $newInvoiceNumber = 'INV-' . str_pad(($lastInvoice ? $lastInvoice->id + 1 : 1), 5, '0', STR_PAD_LEFT);

    //     // إنشاء الفاتورة
    //     $invoice = new Invoice();
    //     $invoice->invoice_number = $newInvoiceNumber;
    //     $invoice->reservation_id = $reservationId;
    //     $invoice->amount = $room->price; // هنا يمكن تخصيص المبلغ حسب نوع الحجز
    //     $invoice->status = 'مدفوعة'; // يمكن تخصيص حالة الفاتورة
    //     $invoice->save();

    //     // تحديث الحجز مع رقم الفاتورة
    //     $reservation->invoice_number = $newInvoiceNumber;
    //     $reservation->save();

    //     return $invoice;
    // }


    // public function reservationLogin(Request $request)
    // {
    //     // تحقق من صحة البيانات المدخلة
    //     $validated = $request->validate([
    //         'national_id' => 'required|string|min:10|max:10', // رقم الهوية
    //         'phone' => 'required|string|min:10|max:10', // رقم الجوال
    //     ]);

    //     // تحقق من وجود الحجز بناءً على رقم الهوية ورقم الجوال
    //     $reservation = Reservation::where('national_id', $request->national_id)
    //         ->where('phone', $request->phone)
    //         ->first();

    //     if ($reservation) {
    //         // تسجيل دخول العميل (تخزين البيانات في الجلسة)
    //         session(['reservation_id' => $reservation->id]);
    //         return redirect()->route('reservation.details', $reservation->id)
    //             ->with('success', 'تم تسجيل الدخول بنجاح!');
    //     } else {
    //         return back()->withErrors(['login_error' => 'بيانات الهوية أو رقم الجوال غير صحيحة']);
    //     }
    // }

    // public function checkout($id)
    // {
    //     // العثور على الحجز باستخدام المعرف
    //     $reservations = Reservation::findOrFail($id);

    //     // تحديث حالة الحجز إلى "تم تسجيل الخروج"
    //     $reservations->status = 'تم تسجيل الخروج';
    //     $reservations->save();

    //     // العثور على الغرفة المرتبطة بهذا الحجز
    //     $room = Room::find($reservations->room_id);

    //     if ($room) {
    //         // تحديث حالة الغرفة إلى "متاحة" ووضعها تحت التنظيف
    //         $room->status = 'available'; // تعيين حالة الغرفة إلى متاحة
    //         $room->is_cleaning = true; // تعيين الغرفة على أنها تحت التنظيف
    //         $room->save();
    //     }

    //     // إعادة التوجيه إلى صفحة الفهرس مع رسالة نجاح
    //     return redirect()->route('reservations.index')->with('success', 'تم تسجيل الخروج بنجاح');
    // }

    // public function checkout($reservationId)
    // {
    //     // العثور على الحجز والغرفة المرتبطة
    //     $reservation = Reservation::findOrFail($reservationId);
    //     $room = $reservation->room;

    //     // تحديث حالة الغرفة لتصبح تحت التنظيف بعد تسجيل الخروج
    //     $room->status = 'available'; // الغرفة تصبح متاحة
    //     $room->is_cleaning = true;   // الغرفة تحت التنظيف
    //     $room->save();

    //     // تحديث حالة الحجز إلى "تم تسجيل الخروج"
    //     $reservation->status = 'تم تسجيل الخروج';
    //     $reservation->check_out = now();
    //     $reservation->save();

    //     // إنشاء الفاتورة
    //     $this->createInvoice($reservationId);

    //     return redirect()->route('reservations.index')->with('success', 'تم تسجيل الخروج بنجاح وتم إنشاء الفاتورة.');
    // }


    //     public function store(Request $request)
    // {
    //     // التحقق من صحة المدخلات
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'phone' => 'required|digits:10|unique:reservations,phone',
    //         'national_id' => 'required|digits:10|unique:reservations,national_id', // تحقق من أن national_id يحتوي على 10 أرقام وهو فريد
    //         'gender' => 'required|in:ذكر,أنثى', // تحقق من الجنس
    //         'nationality' => 'required|string|max:50',
    //         'check_in' => 'required|date',
    //         'check_out' => 'required|date|after:check_in',
    //         'check_out' => 'required|date|after:check_in',
    //         'room_id' => 'required|exists:rooms,id',
    //     ]);

    //     // توليد الرقم التسلسلي بناءً على آخر رقم حجز
    //     $lastReservation = Reservation::latest('id')->first();
    //     if ($lastReservation) {
    //         $lastNumber = (int)substr($lastReservation->reservation_number, 4); // استخراج الرقم
    //         $newReservationNumber = 'RES-' . str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
    //     } else {
    //         $newReservationNumber = 'RES-00001';
    //     }

    //     // جلب سعر الغرفة من جدول الغرف
    //     $room = Room::findOrFail($request->room_id);
    //     // $roomPrice = $room->price;

    //     // إنشاء الحجز وتخزينه في قاعدة البيانات
    //     $reservation = new Reservation();
    //     $reservation->reservation_number = $newReservationNumber;
    //     $reservation->name = $request->name;
    //     $reservation->phone = $request->phone;
    //     $reservation->national_id = $request->national_id;
    //     $reservation->gender = $request->gender;
    //     $reservation->nationality = $request->nationality;
    //     $reservation->check_in = $request->check_in;
    //     $reservation->check_out = $request->check_out;
    //     $reservation->room_id = $request->room_id;
    //     // $reservation->price = $roomPrice; // تعيين السعر للغرفة
    //     $reservation->save();
    //     // dump($request);
    //     return redirect()->route('reservations.index')->with('success', 'created success');
    // }

    // public function show(reservation $reservation , $id)
    // {
    //     $reservations = Reservation::all();

    //     return view('admin.reservations.show', compact('reservations'));
    // }

    // public function show($id)
    // {
    //     // $reservation = Reservation::findOrFail($id);
    //     $reservations = Reservation::findOrFail($id);
    //     $rooms = rooms::all();
    //     // dd($reservation); // تحقق من البيانات هنا
    //     return view('dashboard.reservations.show', compact('reservations', 'rooms'));
    // }

    // public function checkout($id)
    // {
    //     $reservation = Reservation::findOrFail($id);
    //     $reservation->status = 'تم تسجيل الخروج';
    //     $reservation->save();

    //     return redirect()->route('reservations.index')->with('success', 'تم تسجيل الخروج بنجاح');
    // }

        // Check Avaiable rooms
        // function available_rooms(Request $request,$checkin_date){
        //     $arooms=DB::SELECT("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE '$checkin_date' BETWEEN checkin_date AND checkout_date)");
    
        //     $data=[];
        //     foreach($arooms as $room){
        //         $roomTypes=RoomType::find($room->room_type_id);
        //         $data[]=['room'=>$room,'roomtype'=>$roomTypes];
        //     }
    
        //     return response()->json(['data'=>$data]);
        // }


    // public function create(Request $request)
    // {
    //     // توليد الرقم التسلسلي بناء على اخر رقم حجز 
    //     $lastReservation = Reservation::latest('id')->first();

    //     // تحديد الرقم التسلسلي التالي بناءً على الرقم الأخير
    //     if ($lastReservation) {
    //         $lastNumber = (int)substr($lastReservation->reservation_number, 4); // استخراج الرقم التسلسلي من آخر حجز
    //         $newReservationNumber = 'RES-' . str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT); // إضافة أصفار قبل الرقم
    //     } else {
    //         $newReservationNumber = 'RES-00001'; // الرقم الأول إذا لم تكن هناك حجوزات سابقة
    //     }
    //     // التحقق من تمرير `room_id`
    //     $roomId = $request->input('room_id');
    //     $rooms = Room::doesntHave('reservation')->where('id', $roomId)->select('id', 'room_number', 'price')->first();
    //     $customers = Customer::all(); // التأكد من وجود الـ Model و الـ Table للعملاء


    //     if (!$rooms) {
    //         return redirect()->route('reservations.index')->withErrors(['error' => 'الغرفة غير متاحة أو محجوزة']);
    //     }
    //     // جلب الغرف المتاحة فقط مع أرقام الغرف وأسعارها
    //     //  $rooms = rooms::doesntHave('reservation')->select('id', 'room_number', 'price')->get();
    //     return view('dashboard.reservations.create', compact('rooms' , 'newReservationNumber' , 'customers'));
    // }