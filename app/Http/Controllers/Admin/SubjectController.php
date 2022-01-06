<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubject;
use App\Http\Requests\UpdateSubject;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = Subject::orderBy('created_at', 'DESC');

        if (!empty($request->get('keyword'))) {
            $subject = $subjects->where('name', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%');
        }

        $subjects = $subjects->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubject $request)
    {
        $data = $request->validated();

        try {

            Subject::create($data);

            return redirect()->route('admin.subjects.index')->with('success', 'ဖန်တီးမှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Subject Create Exception: ' . $e);
            return redirect()->route('admin.subjects.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('admin.subjects.view', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubject $request, Subject $subject)
    {
        $data = $request->validated();

        try {

            $subject->name = $data['name'];
            $subject->save();

            return redirect()->route('admin.subjects.index')->with('success', 'တည်းဖြတ်မှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Site Setting Update Exception: ' . $e);
            return redirect()->route('admin.subjects.index')->with('error', 'တည်းဖြတ်မှု မအောင်မြင်ပါ။');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        try {

            $subject->delete();

            return redirect()->route('admin.subjects.index')->with('success', 'ဖျက်ခြင်း အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Subject Delete Exception: ' . $e);
            return redirect()->route('admin.subjects.index')->with('error', 'ဖျက်ခြင်း မအောင်မြင်ပါ။');
        }
    }
}
