<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateImageType;
use App\Http\Requests\UpdateImageType;
use App\ImageType;
use Illuminate\Http\Request;

class ImageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $image_types = ImageType::orderBy('created_at', 'DESC');

        if(!empty($request->keyword))
        {
           $image_types = $image_types->where('name', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%');
        }

        $image_types = $image_types->paginate(10);
        return view('admin.image_types.index', compact('image_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.image_types.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateImageType $request)
    {
        $data = $request->validated();

        try {

            ImageType::create($data);

            return redirect()->route('admin.image_types.index')->with('success', 'ဖန်တီးမှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Image Type Create Exception: ' . $e);
            return redirect()->route('admin.image_types.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImageType  $image_type
     * @return \Illuminate\Http\Response
     */
    public function show(ImageType $image_type)
    {
        return view('admin.image_types.view', compact('image_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImageType  $image_type
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageType $image_type)
    {
        return view('admin.image_types.edit', compact('image_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImageType  $image_type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImageType $request, ImageType $image_type)
    {
        $data = $request->validated();

        try {

            $image_type->name = $data['name'];
            $image_type->save();

            return redirect()->route('admin.image_types.index')->with('success', 'တည်းဖြတ်မှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Study Update Exception: ' . $e);
            return redirect()->route('admin.image_types.index')->with('error', 'တည်းဖြတ်မှု မအောင်မြင်ပါ။');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImageType  $image_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageType $image_type)
    {
        try {

            $image_type->delete();

            return redirect()->route('admin.image_types.index')->with('success', 'ဖျက်ခြင်း အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Image Type Delete Exception: ' . $e);
            return redirect()->route('admin.image_types.index')->with('error', 'ဖျက်ခြင်း မအောင်မြင်ပါ။');

        }
    }
}
