<?php

namespace App\Http\Controllers\Admin;

use App\RecommendationType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRecommendationType;
use App\Http\Requests\UpdateRecommendationType;

class RecommendationTypeController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recommendation_types = RecommendationType::orderby('created_at', 'DESC');
        
        if(!empty($request->get('keyword'))){
            $recommendation_types = $recommendation_types->where('name', 'like' , '%' . str_replace( ' ', '%', $request->keyword) . '%');
        }

        $recommendation_types = $recommendation_types->paginate(10);
        return view('admin.recommendation_types.index',compact('recommendation_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.recommendation_types.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRecommendationType $request)
    {
        $data = $request->validated();

        try {          
             
            RecommendationType::create($data);

            return redirect()->route('admin.recommendation_types.index')->with('success', 'ဖန်တီးမှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {
          
            \Log::error('Admin Recommendation Type Create Exception: ' . $e);
            return redirect()->route('admin.recommendation_types.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RecommendationType  $recommendation_type
     * @return \Illuminate\Http\Response
     */
    public function show(RecommendationType $recommendation_type)
    {
        return view('admin.recommendation_types.view',compact('recommendation_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecommendationType  $recommendation_type
     * @return \Illuminate\Http\Response
     */
    public function edit(RecommendationType $recommendation_type)
    {
        return view('admin.recommendation_types.edit',compact('recommendation_type'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecommendationType  $recommendation_type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecommendationType $request, RecommendationType $recommendation_type)
    {
        $data = $request->validated();

        try {
            
            $recommendation_type->name = $data['name'];
            $recommendation_type->save();

            return redirect()->route('admin.recommendation_types.index')->with('success', 'တည်းဖြတ်မှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Recommendation Type Update Exception: ' . $e);
            return redirect()->route('admin.recommendation_types.index')->with('error', 'တည်းဖြတ်မှု မအောင်မြင်ပါ။');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecommendationType  $recommendation_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecommendationType $recommendation_type)
    {
        try {

            $recommendation_type->delete();

            return redirect()->route('admin.recommendation_types.index')->with('success', 'ဖျက်ခြင်း အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Recommendation Type Delete Exception: ' . $e );

            return redirect()->route('admin.recommendation_types.index')->with('error', 'ဖျက်ခြင်း မအောင်မြင်ပါ။');
        }
    
    }
        
    
}
