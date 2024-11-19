<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
        // التأكد من أن المستخدم هو عادي (غير أدمن)
        public function __construct()
        {
            $this->middleware('auth');
        }
    
        // عرض صفحة لوحة تحكم المستخدم
        public function index()
        {
            return view('frontend.user.dashboard'); // يمكنك تخصيص هذا العرض بما يناسبك
        }
}
