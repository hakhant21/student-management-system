<?php

namespace App\Http\Controllers\Admin;

use App\Study;
use App\Enrollment;
use App\StudentStudy;
use App\EntranceApplication;
use App\MatriculationDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EntranceApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, EntranceApplication $entrance_application)
    {
        $studies = Study::where('is_matriculation', 0)
                    ->orderBy('name', 'ASC')
                    ->pluck('name', 'id')
                    ->toArray();

        $applications = EntranceApplication::has('submissions')->orderBy('created_at', 'DESC')
                        ->when($request->get('from') and !$request->get('to'), function ($query) use ($request) {
                            return $query->whereBetween('created_at', [
                                date('Y-m-d H:i:s', strtotime($request->from)), 
                                date('Y-m-d 00:00:00')
                            ]);

                        })->when($request->get('to') and !$request->get('from'), function ($query) use ($request) {
                            return $query->whereBetween('created_at', [
                                date('Y-m-d H:i:s', strtotime($request->to)), 
                                date('Y-m-d 00:00:00')
                            ]);

                        })->when($request->get('from') and $request->get('to'), function ($query) use ($request) {
                            return $query->whereBetween('created_at', [
                                date('Y-m-d H:i:s', strtotime($request->from)), 
                                date('Y-m-d H:i:s', strtotime($request->to))
                            ]);

                        })->when(is_int((Int) $request->get('status')) and $request->status != null, function ($query) use ($request) {
                            return $query->whereHas('submissions', function ($query) use ($request) {
                                            $query->where('status', $request->status)->where('is_expired', 0);
                                        });

                        })->when($request->get('study_id'), function ($query) use ($request) {
                            return $query->whereHas('matriculationDetail', function ($query) use ($request) {
                                                $query->whereHas('prioritizedStudies', function ($query) use ($request) {
                                                    $query->where('study_id', $request->study_id)->where('priority', 0);
                                                });
                                            });

                        })->when($request->get('keyword'), function ($query) use ($request) {
                            return $query->whereHas('profile', function ($query) use ($request) {
                                $query->where(function ($query) use ($request) {
                                    $query->orWhere('name_mm', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('name_en', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('father_name_mm', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('father_name_en', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('mother_name_mm', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('mother_name_en', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('job', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('father_job', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('mother_job', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('contact_phone', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('father_contact_phone', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('mother_contact_phone', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('address', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('father_address', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%')
                                            ->orWhere('mother_address', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%');

                                });
                            }); 
                        })->paginate(10);

        return view('admin.entrance_applications.index', compact('applications', 'studies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntranceApplication  $entrance_application
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, EntranceApplication $entrance_application)
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntranceApplication  $entrance_application
     * @return \Illuminate\Http\Response
     */
    public function storeStatus(Request $request, EntranceApplication $entrance_application)
    {

        try {

            DB::beginTransaction();
            $entrance_application->status = $request->entrance_status;
            $entrance_application->save();

            $submission = $entrance_application->activeSubmission();
            if (!empty($submission)) {
                $submission->status = $request->entrance_status;
                $submission->remark = $request->remark;
                $submission->acted_by = auth()->guard('admin')->user()->id;
                $submission->save();
            }

            DB::commit();

            switch ($request->entrance_status) {
                case '1':

                    return redirect()->route('admin.entrance_applications.show', $entrance_application->id)->with('success', 'အတည်ပြုမှု အောင်မြင်ခဲ့သည်။');
                    break;

                case '2':

                    return redirect()->route('admin.entrance_applications.index')->with('success', 'ငြင်းပယ်မှု အောင်မြင်ခဲ့သည်။');
                    break;

                default:
                    // code...
                    break;
            }

        } catch (\Exception $e) {

            DB::rollback();
            \Log::error('Admin Status Update Exception: ' . $e);
            return redirect()->route('admin.entrance_applications.index')->with('error', 'တစ်ခုခုမှားသွားသည်။ နောက်မှ ထပ်စမ်းကြည့်ပါ။');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntranceApplication  $entrance_application
     * @return \Illuminate\Http\Response
     */
    public function confirmStudy(Request $request, EntranceApplication $entrance_application)
    {
        $data = $request->validate([
            'study' => 'required|exists:studies,id',
            'academic_year_from' => 'required|numeric',
            'academic_year_to' => 'required|numeric',
        ]);

        try {

            DB::beginTransaction();
            StudentStudy::create([
                'user_id' => $entrance_application->user->id,
                'study_id' => $data['study'],
                'acted_by' => auth()->guard('admin')->user()->id,
            ]);

            $entrance_application->user->code()->create();
            Enrollment::create([
                'user_id' => $entrance_application->user->id,
                'academic_year_from' => $data['academic_year_from'],
                'academic_year_to' => $data['academic_year_to'],
            ]);

            DB::commit();

            return redirect()->route('admin.entrance_applications.index')->with('success', 'ဘာသာရပ်အတည်ပြုမှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            DB::rollback();
            \Log::error('Admin Confirm Study Exception: ' . $e);
            return redirect()->route('admin.entrance_applications.index')->with('error', 'တစ်ခုခုမှားသွားသည်။ နောက်မှ ထပ်စမ်းကြည့်ပါ။');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EntranceApplication  $entrance_application
     * @return \Illuminate\Http\Response
     */
    public function show(EntranceApplication $entrance_application)
    {
        $nrc_mm = json_decode($entrance_application->profile->nrc_mm, true);
        $nrc_en = json_decode($entrance_application->profile->nrc_en, true);
        $father_nrc_mm = json_decode($entrance_application->profile->father_nrc_mm, true);
        $father_nrc_en = json_decode($entrance_application->profile->father_nrc_en, true);
        $mother_nrc_mm = json_decode($entrance_application->profile->mother_nrc_mm, true);
        $mother_nrc_en = json_decode($entrance_application->profile->mother_nrc_en, true);


        $images = $entrance_application->images;
        $examinationDepartmentName = $entrance_application->matriculationDetail->examinationDepartment->name;

        $studyName = $entrance_application->matriculationDetail->study->name;

        $markArray = $entrance_application->matriculationDetail->matriculationMarks;

        $totalMark = $entrance_application->matriculationDetail->totalMarks();

        $prioritizedSubjects = $entrance_application->matriculationDetail->prioritizedStudies;

        $matriculationDetails = MatriculationDetail::where('id', $entrance_application->id)->select(['roll_number', 'year'])->get();

        return view('admin.entrance_applications.view', compact(
            'entrance_application',
            'nrc_mm',
            'nrc_en',
            'father_nrc_mm',
            'father_nrc_en',
            'mother_nrc_mm',
            'mother_nrc_en',
            'matriculationDetails',
            'examinationDepartmentName',
            'studyName',
            'markArray',
            'totalMark',
            'prioritizedSubjects',
            'images'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EntranceApplication  $entrance_application
     * @return \Illuminate\Http\Response
     */
    public function edit(EntranceApplication $entrance_application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntranceApplication  $entrance_application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntranceApplication $entrance_application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EntranceApplication  $entrance_application
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntranceApplication $entrance_application)
    {
        try {

            $entrance_application->delete();

            return redirect()->route('admin.entrance_applications.index')->with('success', 'ဖျက်ခြင်း အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            \Log::error('Admin Examination Department Delete Exception: ' . $e);
            return redirect()->route('admin.entrance_applications.index')->with('error', 'ဖျက်ခြင်း မအောင်မြင်ပါ။');
        }
    }
}
