<?php

namespace App\Http\Controllers\Admin;

use App\Study;
use App\StudentStudy;
use App\MajorChangeHistory;
use App\ProfileInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMajorChangeHistory;

class MajorChangeHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studies = Study::pluck('name', 'id')->toArray();
        $majorChangeHistories = MajorChangeHistory::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.major_change_histories.index',compact('studies', 'majorChangeHistories'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\MajorChangeHistory  $majorChangeHistory
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = ProfileInformation::has('user.confirmedStudy')->select('user_id', 'name_mm')->get();
        $studies = Study::where('is_matriculation', 0)->select('id', 'name')->get();

        return view('admin.major_change_histories.add', compact('students', 'studies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMajorChangeHistory $request)
    {
        $data = $request->validated();
        $oldStudy = StudentStudy::where('user_id', $data['user_id'])->first();
        if (empty($oldStudy)) {
            return redirect()->route('admin.major_change_histories.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');
        }
        $data['old_study_id'] = $oldStudy->study_id;

        if ($data['old_study_id'] === $data['new_study_id']) {
            return redirect()->route('admin.major_change_histories.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');
        }

        try {

            DB::beginTransaction();
            $majorChange = MajorChangeHistory::create($data);
            DB::commit();

            return redirect()->route('admin.major_change_histories.index')->with('success', 'ဖန်တီးမှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            DB::rollback();
            \Log::error('Admin MajorChangeHistory Create Exception: ' . $e);
            return redirect()->route('admin.major_change_histories.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MajorChangeHistory  $majorChangeHistory
     * @return \Illuminate\Http\Response
     */
    public function show(MajorChangeHistory $majorChangeHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MajorChangeHistory  $majorChangeHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(MajorChangeHistory $majorChangeHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MajorChangeHistory  $majorChangeHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MajorChangeHistory $majorChangeHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MajorChangeHistory  $majorChangeHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MajorChangeHistory $majorChangeHistory)
    {
        try {

            $majorChangeHistory->delete();
            return redirect()->route('admin.major_change_histories.index')->with('success', 'ဖျက်ခြင်း အောင်မြင်ခဲ့သည်။');

        } catch (\Throwable $th) {

            \Log::error('Admin Major Change Delete Exception: ' . $e);
            return redirect()->route('admin.major_change_histories.index')->with('error', 'ဖျက်ခြင်း မအောင်မြင်ပါ။');

        }
    }
}
