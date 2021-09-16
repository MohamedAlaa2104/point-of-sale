<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Setting::create([
            'name_ar'=>'اسم الموقع',
            'name_en'=>'Site name',
            'keywords_ar'=>'الكلمات المفتاحية',
            'keywords_en'=>'Keywords',
            'description_ar'=>'وصف الموقع الذي يظهر في جوجل',
            'description_en'=>'Website description which appear in google search',
            'email'=>'Support mail',
            'phone'=>'Phone number',
            'website_link'=>'Website link',
            'address_ar'=>'عنوان الشركة',
            'address_en'=>'The address of the company',
            'map'=>'<iframe width="250" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=250&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>',
            'facebook'=>'facebook link',
            'linkedin'=>'linkedin link',
            'youtube'=>'youtube link',
            'twitter'=>'twitter link',
            'instagram'=>'instagram link',
        ]);
    }
}
