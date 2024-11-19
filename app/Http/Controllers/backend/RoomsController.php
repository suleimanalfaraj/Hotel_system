<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return view('backend.rooms.index' , compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('backend.rooms.create');
    // }

        public function create()
    {
        // توليد رقم الغرفة التسلسلي
        $lastRoom = Room::latest('id')->first();
        $newRoomNumber = $lastRoom ? str_pad($lastRoom->id + 1, 3, '0', STR_PAD_LEFT) : '001';

        return view('backend.rooms.create', compact('newRoomNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */


     public function store(Request $request)
    {
        // تحقق من صحة المدخلات
        $request->validate([
            'room_number' => 'required|integer|min:1|unique:rooms,room_number', // تحقق من أن رقم الغرفة فريد
            'room_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
        ]);

        // إضافة الغرفة
        $room = new Room(); // تأكد من أن اسم الكلاس Room وليس rooms
        $room->room_number = $request->room_number; // الرقم التسلسلي للغرفة
        $room->room_type = $request->room_type;
        $room->price = $request->price;
        $room->status = 'available'; // الغرفة تكون متاحة عند إضافتها
        $room->save();

        return redirect()->route('rooms.index')->with('success','success create rooms');
    }
   

    public function show(Room $room)
    {
        return view('backend.rooms.show', compact('room'));
    }
    


    public function edit(Room $room)
    {
        return view('backend.rooms.edit', compact('room'));
    }
    


    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => 'required',
            'room_type' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
    
        $room->update($request->all());
        return redirect('/rooms')->with('success', 'تم تحديث بيانات الغرفة بنجاح!');
    }
    


    public function destroy(Room $room)
    {
        $room->delete();
        return redirect('/rooms')->with('success', 'تم حذف الغرفة بنجاح!');
    }
    
}


    // public function store(Request $request)
    // {
    //     $rooms = rooms::create($request->all());
    //     return redirect()->route('rooms.index')->with('success','success create rooms');
    //     // dd($request); 
    // }

    // public function store(Request $request)
    // {
    //     // التحقق من صحة البيانات (التحقق من عدد الغرف)
    //     $request->validate([
    //         'room_number' => 'required|integer|min:1', // يجب أن يكون عدد الغرف عدد صحيح أكبر من 0
    //         'room_type' => 'required|string|max:255',
    //         'room_price' => 'required|numeric|min:0',
    //     ]);
    
    //     // جلب العدد المطلوب من الغرف من المدخلات
    //     $room_number = $request->input('room_number');
    //     $room_type = $request->input('room_type');
    //     $room_price = $request->input('room_price');
    
    //     // إضافة الغرف
    //     for ($i = 0; $i < $room_number; $i++) {
    //         // إنشاء غرفة جديدة
    //         rooms::create([
    //             'room_type' => $room_type,
    //             'room_price' => $room_price,
    //             'room_number' => $this->generateRoomNumber(), // يمكنك إضافة وظيفة لتوليد رقم الغرفة
    //         ]);
    //     }
    
    //     // إعادة التوجيه مع رسالة نجاح
    //     return redirect()->route('rooms.index')->with('success', 'تم إضافة الغرف بنجاح');
    // }