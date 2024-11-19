<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\rooms;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rooms = Room::all();
        return view('housing.home' , compact('rooms')); // edit name reservations
    }

    // public function new_reservation()
    // {
    //     return view('admin.housing.new-reservation');
    // }

    public function housing()
    {
        return view('housing.housing');
    }
}
