<?php

namespace App\Http\Controllers\Admin;

use App\Enrollment;
use App\ProfileInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEnrollment;
use App\Http\Requests\UpdateEnrollment;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments = Enrollment::orderBy('created_at', 'DESC');

        $enrollments = $enrollments->paginate(10);
        return view('admin.enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = ProfileInformation::has('user.confirmedStudy')->pluck('name_mm', 'user_id')->toArray();
        return view('admin.enrollments.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEnrollment $request)
    {
        $data = $request->validated();

        try {

            Enrollment::create($data);

            return redirect()->route('admin.enrollments.index')->with('success', 'စာရင်းသွင်းခြင်းဖန်တီးမှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            DB::rollback();
            \Log::error('Admin Enrollment Create Exception: ' . $e);
            return redirect()->route('admin.enrollments.index')->with('error', 'တစ်ခုခုမှားသွားသည်။ နောက်မှ ထပ်စမ်းကြည့်ပါ။');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit(Enrollment $enrollment)
    {
        $users = ProfileInformation::has('user.confirmedStudy')->pluck('name_mm', 'user_id')->toArray();
        return view('admin.enrollments.edit', compact('users', 'enrollment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnrollment $request, Enrollment $enrollment)
    {
        $data = $request->validated();
        try {

            $enrollment->user_id = $data['user_id'];
            $enrollment->academic_year_from = $data['academic_year_from'];
            $enrollment->academic_year_to = $data['academic_year_to'];
            $enrollment->roll_number = $data['roll_number'];
            $enrollment->save();

            return redirect()->route('admin.enrollments.index')->with('success', 'စာရင်းသွင်းခြင်းတည်းဖြတ်မှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {
            \Log::error('Admin Enrollment Update Exception: ' . $e);
            return redirect()->route('admin.enrollments.index')->with('error', 'တစ်ခုခုမှားသွားသည်။ နောက်မှ ထပ်စမ်းကြည့်ပါ။');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        try {

            $enrollment->delete();

            return redirect()->route('admin.enrollments.index')->with('success', 'စာရင်းသွင်းခြင်းဖျက်ခြင်း အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {
            \Log::error('Admin Enrollment Delete Exception: ' . $e);
            return redirect()->route('admin.enrollments.index')->with('error', 'တစ်ခုခုမှားသွားသည်။ နောက်မှ ထပ်စမ်းကြည့်ပါ။');
        }
    }
}
