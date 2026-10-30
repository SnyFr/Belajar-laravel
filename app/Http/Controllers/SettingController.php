<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $title = "Setting Management - PPKD Sticker";
        $setting = Setting::pluck('value', 'key');
        return view("admin.setting.index", compact("title", 'setting'));
    }
    public function update(Request $request) 
    {
        $validated = $request->validate(
            [
                'site_name'         => 'nullable|string|max:255',
                'site_tagline'      => 'nullable|string|max:255',
                'site_description'  => 'nullable|string|max:255',
                'site_logo'         => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',

                'phone'         => 'nullable|string|max:100',
                'email_upload'  => 'nullable|string|max:255',
                'email_order'   => 'nullable|string|max:255',
                'address'       => 'nullable|string|max:1000',

                'url_shopee'    => 'nullable|url|max:255',
                'url_facebook'  => 'nullable|url|max:255',
                'url_instagram' => 'nullable|url|max:255',
                'url_youtube'   => 'nullable|url|max:255',
                'url_tiktok'    => 'nullable|url|max:255',
            ]
        );

        if ($request->hasFile('site_logo')) {
            $setting = Setting::where('key', 'site_logo')->first();
            if ($setting && $setting->value ) {
                //hapus gambar
                Storage::disk('public')->delete($setting->value);
            };
            $path = $request->file('site_logo')->store('setting', 'public');
            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                [
                    'value' => $path,
                    'label' => "site_logo",
                    'group' => 'general',
                    'type'  => 'image',
                ]
            );
        }

        $ignoreKeys = ['site_logo'];
        foreach ($validated as $key => $value) {
            if (in_array($key, $ignoreKeys)) {
                continue;
            }
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'label' => ucwords(str_replace('_',' ', $key)), //Site Name
                    'group' => 'general',
                    'type'  => 'text',
                ]
            );
        }
        return redirect()->route('admin.settings')->with('success','Settings on website PPKD Sticker has been saved!');
    }
}
