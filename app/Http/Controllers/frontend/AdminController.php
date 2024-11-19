<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
        // التأكد من أن المستخدم هو أدمن
        public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('admin');  // تأكد من أن المستخدم هو أدمن
        }
    
        // عرض صفحة لوحة تحكم الأدمن
        public function index()
        {
            return view('frontend.admin.dashboard'); // يمكنك تخصيص هذا العرض بما يناسبك
        }
}
