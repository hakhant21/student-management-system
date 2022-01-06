<?php

namespace App\Http\Controllers\Admin;

use App\ExaminationDepartment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateExaminationDepartment;
use App\Http\Requests\UpdateExaminationDepartment;
use Illuminate\Http\Request;

class ExaminationDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $examination_departments = ExaminationDepartment::orderBy('created_at', 'DESC');

        if (!empty($request->get('keyword'))) {
            $examination_departments = $examination_departments->where('name', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%');
        }

        $examination_departments = $examination_departments->paginate(10);
        return view('admin.examination_departments.index', compact('examination_departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.examination_departments.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateExaminationDepartment $request)
    {
        $data = $request->validated();

        try {

            ExaminationDepartment::create($data);

            return redirect()->route('admin.examination_departments.index')->with('success', 'ဖန်တီးမှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Examination Department Create Exception: ' . $e);
            return redirect()->route('admin.examination_departments.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExaminationDepartment  $examination_department
     * @return \Illuminate\Http\Response
     */
    public function show(ExaminationDepartment $examination_department)
    {
        return view('admin.examination_departments.view', compact('examination_department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExaminationDepartment  $examination_department
     * @return \Illuminate\Http\Response
     */
    public function edit(ExaminationDepartment $examination_department)
    {
        return view('admin.examination_departments.edit', compact('examination_department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExaminationDepartment  $examination_department
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExaminationDepartment $request, ExaminationDepartment $examination_department)
    {
        $data = $request->validated();

        try {

            $examination_department->name = $data['name'];
            $examination_department->save();

            return redirect()->route('admin.examination_departments.index')->with('success', 'တည်းဖြတ်မှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Examination Department Update Exception: ' . $e);
            return redirect()->route('admin.examination_departments.index')->with('error', 'တည်းဖြတ်မှု မအောင်မြင်ပါ။');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExaminationDepartment  $examination_department
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExaminationDepartment $examination_department)
    {
        try {

            $examination_department->delete();

            return redirect()->route('admin.examination_departments.index')->with('success', 'ဖျက်ခြင်း အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Examination Department Delete Exception: ' . $e);
            return redirect()->route('admin.examination_departments.index')->with('error', 'ဖျက်ခြင်း မအောင်မြင်ပါ။');
        }
    }
}
