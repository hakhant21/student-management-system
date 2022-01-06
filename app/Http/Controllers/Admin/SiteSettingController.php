<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use App\SiteSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSiteSetting;
use App\Http\Requests\UpdateSiteSetting;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $setting = SiteSetting::first();

        $sliders = [];
        $slideImages = Slider::pluck('path', 'id')->toArray();
        if (!empty($slideImages)) {
            foreach ($slideImages as $key => $value) {
                $sliders[] = [
                    'id' => $key,
                    'src' => asset($value)
                ];
            }
        }

        return view('admin.settings.form', compact('setting', 'sliders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSiteSetting $request)
    {
        $data = $request->validated();

        if (!empty($data['images'])) {
            $images = $data['images'];
            unset($data['images']);

            $imagesPathArr = $this->uploadImages($images, 'sliders');
        }

        $logo = $data['logo'];
        $pathArr = $this->uploadImages([$logo], 'setting');
        $data['logo'] = $pathArr[0]['path'];

        $digital_signature = $data['digital_signature'];
        $pathArr = $this->uploadImages([$digital_signature], 'setting');
        $data['digital_signature'] = $pathArr[0]['path'];

        DB::beginTransaction();
        try {

            SiteSetting::create($data);
            if (!empty($imagesPathArr)) {
                Slider::insert($imagesPathArr);
            }

            DB::commit();

            return redirect()->route('admin.settings')->with('success', 'ဆက်တင်များကို အောင်မြင်စွာ ဖန်တီးခဲ့သည်။');

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::error('Admin Site Setting Create Exception: ' . $e);
            return redirect()->route('admin.settings')->with('error', 'ဆက်တင်များကို အောင်မြင်စွာ မဖန်တီးနိုင်ခဲ့ပါ။');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SiteSetting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(SiteSetting $setting)
    {
        return view('admin.settings.view', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateSiteSetting  $request
     * @param  \App\SiteSetting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiteSetting $request)
    {
        $data = $request->validated();

        try {

            $setting = SiteSetting::first();
            if (empty($setting)) {
                abort(400);
            }

            if (!empty($data['logo'])) {
                $logo = $data['logo'];
                $pathArr = $this->uploadImages([$logo], 'setting');
                $data['logo'] = $pathArr[0]['path'];
                $setting->logo = $data['logo'];
            }

            if (!empty($data['digital_signature'])) {
                $digital_signature = $data['digital_signature'];
                $pathArr = $this->uploadImages([$digital_signature], 'setting');
                $data['digital_signature'] = $pathArr[0]['path'];
                $setting->digital_signature = $data['digital_signature'];
            }

            $imagesPathArr = [];
            if (!empty($data['images'])) {
                $images = $data['images'];
                unset($data['images']);

                $imagesPathArr = $this->uploadImages($images, 'sliders');
            }

            DB::beginTransaction();

            // Delete removed images
            $oldSlideImages = Slider::pluck('id')->toArray();
            if (empty($data['old_images'])) {
                $data['old_images'] = [];
            }
            $imagesToDelete = [];
            if (count($data['old_images']) != count($oldSlideImages)) {
                foreach ($oldSlideImages as $key => $value) {
                    if (!in_array($value, $data['old_images'])) {
                        Slider::where('id', $value)->delete();
                    }
                }
            }

            // Store new images
            if (!empty($imagesPathArr)) {
                Slider::insert($imagesPathArr);
            }

            $setting->app_name = $data['app_name'];
            $setting->address = $data['address'];
            $setting->phone = $data['phone'];
            $setting->email = $data['email'];
            $setting->google_map_iframe = $data['google_map_iframe'];
            $setting->copyright_info = $data['copyright_info'];
            $setting->save();

            DB::commit();

            return redirect()->route('admin.settings')->with('success', 'ဆက်တင်များကို အောင်မြင်စွာ မွမ်းမံပြီးပါပြီ။');

        } catch (\Exception $e) {

            DB::rollback();
            \Log::error('Admin Site Setting Update Exception: ' . $e);
            return redirect()->route('admin.settings')->with('error', 'ဆက်တင်များကို အောင်မြင်စွာ မမွမ်းမံနိုင်ခဲ့ပါ။');
        }
    }

    private function uploadImages($images = [], $path)
    {
        $pathArr = [];
        Storage::disk(config('services.storage.file_storage_link'))->makeDirectory($path);
        if (!empty($images)) {
            foreach ($images as $key => $value) {
                $image = $value;
                $imageName = $image->getClientOriginalName();
                Storage::disk(config('services.storage.file_storage_link'))->putFileAs($path, $image, $imageName);
                $pathArr[] = ['path' => 'storage/' . $path . '/' . $imageName];
            }
        }

        return $pathArr;
    }

}
