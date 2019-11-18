<?php

namespace Joonas1234\NovaSettings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Setting;

class SettingsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $settings = config('nova.nova_settings.available_settings');
        if(is_array($settings) && count($settings)) {
            foreach($settings as $setting) {
                $settings[$setting] = Setting::get($setting);
            }            
        } else {
            $settings = Setting::all();
        }
        return $settings;
    }

    public function update(Request $request)
    {  
        Setting::set($request->key, $request->value);
        Setting::save();
        
        return response([
            'key' => $request->key,
            'value' => Setting::get($request->key)
        ], 200);
    }
}
