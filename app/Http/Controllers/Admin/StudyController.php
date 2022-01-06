<?php

namespace App\Http\Controllers\Admin;

use App\Study;
use App\Subject;
use App\SubjectStudy;
use Illuminate\Http\Request;
use App\Http\Requests\CreateStudy;
use App\Http\Requests\UpdateStudy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $studies = Study::orderBy('created_at', 'DESC');

        if (!empty($request->get('keyword'))) {
            $studies = $studies->where('name', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%');
        }

        $studies = $studies->paginate(10);
        return view('admin.studies.index', compact('studies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::orderBy('id', 'ASC')->pluck('name', 'id')->toArray();
        return view('admin.studies.add', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStudy $request)
    {
        $data = $request->validated();

        try {

            DB::beginTransaction();
            $study = Study::create($data);

            if (!empty($data['subjects'])) {
                $study->subjectStudies()->createMany($data['subjects']);
            }

            DB::commit();

            return redirect()->route('admin.studies.index')->with('success', 'ဖန်တီးမှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::error('Admin Study Create Exception: ' . $e);
            return redirect()->route('admin.studies.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function show(Study $study)
    {
        return view('admin.studies.view', compact('study'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function edit(Study $study)
    {
        $subjects = Subject::orderBy('id','ASC')->pluck('name', 'id')->toArray();

        $selectedSubjects = Subject::with('subjectStudies')
                    ->whereHas('subjectStudies', function ($query) use($study){
                        $query->where('study_id', $study->id);
                    })
                    ->pluck('id')
                    ->toArray();

        return view('admin.studies.edit', compact('study', 'subjects', 'selectedSubjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudy $request, Study $study)
    {

        $data = $request->validated();
        $study->name = $data['name'];
        $study->is_matriculation = $data['is_matriculation'];
        $study->save();

        // dd($request->subjects);
        $editedSubjects = new SubjectStudy();


        foreach($request->subjects as $value)
        {
            $editedSubjects->subject_id = $value;
        }

        $editedSubjects->study_id = $request->id;
        $editedSubjects->save();


        // try {

        //     $study->name = $data['name'];
        //     $study->is_matriculation = $data['is_matriculation'];
        //     $study->save();

        //     $study->subjectStudies()->updateMany($data['subjects']);

        //     return redirect()->route('admin.studies.index')->with('success', 'တည်းဖြတ်မှု အောင်မြင်ခဲ့သည်။');

        // } catch (\Exception $e) {

        //     \Log::error('Admin Study Update Exception: ' . $e);
        //     return redirect()->route('admin.studies.index')->with('error', 'တည်းဖြတ်မှု မအောင်မြင်ပါ။');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Study  $study
     * @return \Illuminate\Http\Response
     */
    public function destroy(Study $study)
    {
        try {

            $study->delete();

            return redirect()->route('admin.studies.index')->with('success', 'ဖျက်ခြင်း အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Study Delete Exception: ' . $e);
            return redirect()->route('admin.studies.index')->with('error', 'ဖျက်ခြင်း မအောင်မြင်ပါ။');
        }
    }
}
