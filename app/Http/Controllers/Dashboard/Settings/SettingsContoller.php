<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsContoller extends Controller
{
    //
    public function index()
    {
        $settings = Setting::findOrFail(1);
        return view('dashboard.settings.index')->with(['settings'=>$settings]);
    }

    public function update(Request $request)
    {
        $settings = Setting::findOrFail(1);
        $settings->update([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'keywords_ar'=>$request->keywords_ar,
            'keywords_en'=>$request->keywords_en,
            'description_ar'=>$request->description_ar,
            'description_en'=>$request->description_en,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'website_link'=>$request->website_link,
            'address_ar'=>$request->address_ar,
            'address_en'=>$request->address_en,
            'map'=>$request->map,
            'facebook'=>$request->facebook,
            'linkedin'=>$request->linkedin,
            'youtube'=>$request->youtube,
            'twitter'=>$request->twitter,
            'instagram'=>$request->instagram,
        ]);
        return back()->with('success', 'تم تنفيذ طلبك بنجاح');
    }
}
