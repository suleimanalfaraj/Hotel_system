<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        $setting = Setting::first(); // جلب الإعداد الأول (في حال كان هناك إعداد واحد فقط)
        return view('backend.setting.index', compact('setting')); // تمرير الإعداد إلى الواجهة
    }


    public function create(){
        return view('backend.setting.create');
    }


    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'hotel_name'    => 'required|string|max:255',
            'tax_number'    => 'required|string|max:50',
            'company_number' => 'required|string|max:50',
            'email'         => 'required|email|max:255',
            'city'          => 'required|string|max:100',
            'street'        => 'required|string|max:100',
        ]);
    
        // Check if settings already exist
        $settings = Setting::first();
    
        // If not, create a new instance
        if (!$settings) {
            $settings = new Setting();
        }
    
        // Update settings with the request data
        $settings->fill($request->all());
        $settings->save();
    
        // Redirect back with a success message
        return redirect()->route('settings.index')->with('success', 'تم حفظ إعدادات النظام بنجاح');
    }


    public function show($id)
    {
        $setting = Setting::findOrFail($id); // البحث عن الإعداد بواسطة المعرف
        return view('backend.setting.show', compact('setting'));
    }

    // دالة تعديل إعداد موجود (عرض صفحة التعديل)
    public function edit($id)
    {
        $setting = Setting::findOrFail($id); // البحث عن الإعداد بواسطة المعرف
        return view('backend.setting.edit', compact('setting'));
    }

    // دالة تحديث الإعداد بعد التعديل
    public function update(Request $request, $id)
    {
        // تحقق من صحة البيانات
        $request->validate([
            'hotel_name'    => 'required|string|max:255',
            'tax_number'    => 'required|string|max:50',
            'company_number' => 'required|string|max:50',
            'email'         => 'required|email|max:255',
            'city'          => 'required|string|max:100',
            'street'        => 'required|string|max:100',
        ]);

        // جلب الإعداد وتحديث البيانات
        $setting = Setting::findOrFail($id);
        $setting->fill($request->all());
        $setting->save();

        // إعادة التوجيه برسالة نجاح
        return redirect()->route('settings.index')->with('success', 'تم تحديث إعدادات النظام بنجاح');
    }
    
    // دالة حذف الإعداد
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();

        // إعادة التوجيه برسالة نجاح
        return redirect()->route('settings.index')->with('success', 'تم حذف الإعداد بنجاح');
    }
}






