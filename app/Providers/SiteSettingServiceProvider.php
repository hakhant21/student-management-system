<?php

namespace App\Providers;

use App\SiteSetting;
use App\Slider;
use Illuminate\Support\ServiceProvider;

class SiteSettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Settings
        $settings = [
            'app_name' => 'SMS',
            'logo' => asset('dist/settings/no-image.png'),
            'address' => '155 street, Tamwe, Yangon',
            'google_map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.342175746279!2d96.17173551481791!3d16.80937268842747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ed0e1d85be57%3A0x134f8380cbff2353!2sYoon%20Han%20Thar%20Private%20Company%20Limited!5e0!3m2!1smy!2smm!4v1639542398842!5m2!1smy!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'phone' => '09454434438',
            'email' => 'yoonhanthar@gmail.com',
            'copyright_info' => '© Copyright 2021 by Yoon Han Thar. All Rights Reserved.',
            'digital_signature' => asset('dist/settings/no-image.png'),
        ];

        try {
            
            $settingData = SiteSetting::first();
            if (!empty($settingData)) {
                $this->app['config']['settings'] = $settingData->toArray();
            }

        } catch (\Illuminate\Database\QueryException $e) {

            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1146) {
                $this->app['config']['settings'] = $settings;
            }
        }

        // Sliders
        $sliders[] = asset('dist/settings/no-image.png');
        try {
            
            $sliderData = Slider::pluck('path');
            if (!empty($sliderData)) {
                $this->app['config']['slider'] = $sliderData->toArray();
            }

        } catch (\Illuminate\Database\QueryException $e) {

            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1146) {
                $this->app['config']['slider'] = $sliders;
            }
        }
    }
}
