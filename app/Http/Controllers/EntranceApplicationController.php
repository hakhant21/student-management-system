<?php

namespace App\Http\Controllers;

use App\User;
use App\Study;
use App\Subject;
use App\ImageType;
use App\ExaminationDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EntranceApplicationController extends Controller
{
    public function showRelevantForm(Request $request)
    {
        if (!$request->session()->has('matriculation_detail')) {
            return redirect()->route('entrance.matriculation-detail-form');
        }

        if (!$request->session()->has('profile_information')) {
            return redirect()->route('entrance.profile-info-form');
        }

        if (!$request->session()->has('image_uploads')) {
            return redirect()->route('entrance.image-uploads-form');
        }
    }

    public function showMatriculationDetailForm(Request $request)
    {
        $oldData = $request->session()->get('matriculation_detail');
        $examDeparts = ExaminationDepartment::orderBy('id', 'ASC')->pluck('name', 'id')->toArray();
        $studies = Study::where('is_matriculation', true)->orderBy('id', 'ASC')->pluck('name', 'id')->toArray();
        $subjects = Subject::orderBy('id', 'ASC')->pluck('name', 'id')->toArray();
        $uniStudies = Study::where('is_matriculation', false)->orderBy('id', 'ASC')->pluck('name', 'id')->toArray();

        $studiesWithSubjects = [];
        $allStudyObjs = Study::get();
        foreach ($allStudyObjs as $key => $value) {
            if ($value->subjectStudies()->count() > 0) {
                foreach ($value->subjectStudies as $subjectKey => $subjectValue) {
                    $studiesWithSubjects[$value->id][] = $subjectValue->subject_id;
                }
            }
        }

        $years = [];
        for ($i=1988; $i < date('Y'); $i++) {
            $years[] = $i;
        }

        return view('matriculation_detail', compact(
            'studies',
            'subjects',
            'years',
            'examDeparts',
            'uniStudies',
            'studiesWithSubjects',
            'oldData'
        ));
    }

    public function showProfileInfoForm(Request $request)
    {
        $oldData = $request->session()->get('profile_information');
        $nrcOptionsMM = config('nrc_options_mm');
        $nrcOptionsEN = config('nrc_options_en');
        return view('profile_information', compact('nrcOptionsMM', 'nrcOptionsEN', 'oldData'));
    }

    public function showImageUploadsForm()
    {
        $imageTypes = ImageType::pluck('name', 'id')->toArray();
        return view('image_uploads', compact('imageTypes'));
    }

    public function store(Request $request)
    {
        $studentPassportPhotoImageType = ImageType::where('name', "Student's Passport Photo")->first();
        $data = $request->all();
        unset($data['_token']);

        if (!empty($data['form_name'])) {

            switch ($data['form_name']) {

                case 'matriculation_detail':

                    $validate = validator($request->all(), [
                        'roll_number' => 'required|unique:matriculation_details',
                        'examination_department_id' => 'required|exists:examination_departments,id',
                        'year' => 'required|string|max:4',
                        'study_id' => 'required|exists:studies,id',
                        'matriculation_marks' => 'required|array',
                        'prioritized_studies' => 'required|array',
                    ]);

                    $formName = 'matriculation_detail';
                    $routeName = 'entrance.profile-info-form';
                    break;

                case 'profile_information':

                    $validate = validator($request->all(), [
                        'name_title_mm' => 'required|string|max:4',
                        'name_mm' => 'required|stirng|max:30',
                        'name_title_en' => 'required|string|max:4',
                        'name_en' => 'required|stirng|max:30',
                        'nrc_holding_status_mm' => 'required|bool',
                        'nrc_region_mm' => 'required',
                        'nrc_township_mm' => 'required',
                        'nrc_type_mm' => 'required',
                        'nrc_number_mm' => 'required',
                        'nrc_region_en' => 'required',
                        'nrc_township_en' => 'required',
                        'nrc_number_en' => 'required',
                        'race' => 'required|string|max:20',
                        'religion' => 'required|string|max:20',
                        'date_of_birth' => 'required|date',
                        'job' => 'required|string|max:20',
                        'contact_phone' => 'required|string|max:20',
                        'email' => 'required|email',
                        'address' => 'required|string|max:200',

                        'father_name_title_mm' => 'required',
                        'father_name_title_en' => 'required',
                        'father_name_en' => 'required',
                        'father_death_status' => 'required|bool',
                        'father_nrc_region_mm' => 'required',
                        'father_nrc_township_mm' => 'required',
                        'father_nrc_type_mm' => 'required',
                        'father_nrc_number_mm' => 'required',
                        'father_nrc_region_en' => 'required',
                        'father_nrc_township_en' => 'required',
                        'father_nrc_type_en' => 'required',
                        'father_nrc_number_en' => 'required',
                        'father_nrc_number_en' => 'required',
                        'father_race' => 'required|string|max:20',
                        'father_religion' => 'required|string|max:20',
                        'father_date_of_birth' => 'date',
                        'father_job' => 'string|max:20',
                        'father_contact_phone' => 'string|max:20',
                        'father_email' => 'email',
                        'father_address' => 'string|max:200',

                        'mother_name_title_mm' => 'required',
                        'mother_name_title_en' => 'required',
                        'mother_name_en' => 'required',
                        'mother_death_status' => 'required|bool',
                        'mother_nrc_region_mm' => 'required',
                        'mother_nrc_township_mm' => 'required',
                        'mother_nrc_type_mm' => 'required',
                        'mother_nrc_number_mm' => 'required',
                        'mother_nrc_region_en' => 'required',
                        'mother_nrc_township_en' => 'required',
                        'mother_nrc_type_en' => 'required',
                        'mother_nrc_number_en' => 'required',
                        'mother_nrc_number_en' => 'required',
                        'mother_race' => 'required|string|max:20',
                        'mother_religion' => 'required|string|max:20',
                        'mother_date_of_birth' => 'date',
                        'mother_job' => 'string|max:20',
                        'mother_contact_phone' => 'string|max:20',
                        'mother_email' => 'email',
                        'mother_address' => 'string|max:200',
                    ]);

                    $formName = 'profile_information';
                    $routeName = 'entrance.image-uploads-form';
                    break;

                case 'image_uploads':

                    $validate = validator($request->all(), [
                        'images' => 'required|array',
                    ]);

                    $formName = 'image_uploads';
                    break;

                default:
                    abort(403);
                    break;
            }

            if (!empty($formName)) {
                unset($data['form_name']);
                $request->session()->put($formName, $data);
            }
        }

        if (!empty($routeName)) {
            return redirect()->route($routeName);
        }

        $matriculationDetail = session('matriculation_detail');
        $profileInfo = session('profile_information');
        $imageUploads = $data;
        $data = [];
        $randomPassword = $this->randomPassword(8);

        try {

            DB::beginTransaction();
            $user = User::create([
                'name' => $profileInfo['name_title_mm'] . $profileInfo['name_mm'],
                'email' => $profileInfo['email'],
                'password' => Hash::make($randomPassword),
            ]);

            $application = $user->application()->create();

            // Decide whether it is to save as a draft or as a submission
            switch ($imageUploads['submit_option']) {
                case 'save':
                    break;

                case 'submit':
                    $application->submissions()->create();
                    break;

                default:
                    $application->submissions()->create();
                    break;
            }

            $matriculationDetailObj = $application->matriculationDetail()->create([
                'roll_number' => $matriculationDetail['roll_number'],
                'examination_department_id' => $matriculationDetail['examination_department_id'],
                'study_id' => $matriculationDetail['study_id'],
                'year' => $matriculationDetail['year'],
            ]);

            $matriculationMarks = [];
            if (!empty($matriculationDetail['matriculation_marks'])) {
                foreach ($matriculationDetail['matriculation_marks'] as $key => $value) {
                    if (!empty($value)) {
                        $matriculationMarks[] = [
                            'subject_id' => $key,
                            'mark' => $value,
                            'user_id' => $user->id,
                        ];
                    }
                }

                $matriculationDetailObj->matriculationMarks()->createMany($matriculationMarks);
            }

            $prioritizedStudies = [];
            $priorities = [
                'ပထမဦးစားပေး',
                'ဒုတိယဦးစားပေး',
                'တတိယဦးစားပေး',
                'စတုတ္ထဦးစားပေး'
            ];

            if (!empty($matriculationDetail['prioritized_studies'])) {
                foreach ($matriculationDetail['prioritized_studies'] as $key => $value) {
                    if (!empty($value)) {
                        $prioritizedStudies[] = [
                            'study_id' => $value,
                            'user_id' => $user->id,
                            'priority' => $key,
                            'priority_mm' => $priorities[$key],
                        ];
                    }
                }

                $matriculationDetailObj->prioritizedStudies()->createMany($prioritizedStudies);
            }

            $images = [];
            if (!empty($imageUploads['images'])) {
                foreach ($imageUploads['images'] as $key => $value) {
                    if (!empty($value)) {

                        $image = $value;
                        $image = str_replace('data:image/png;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageName = time().'.'.'png';

                        $path = Storage::disk(
                            config('services.storage.file_storage_link')
                        )->makeDirectory('/entrance_applications');

                        \File::put(storage_path('app/public/entrance_applications'). '/' . $imageName, base64_decode($image));

                        // Add Student Passport Photo to users table
                        if (!empty($studentPassportPhotoImageType)) {
                            if ($key == $studentPassportPhotoImageType->id) {
                                $user->image = "entrance_applications/$imageName";
                                $user->save();
                            }
                        }

                        $images[] = [
                            'image_type_id' => $key,
                            'path' => "storage/entrance_applications/$imageName",
                            'user_id' => $user->id,
                        ];
                    }
                }

                $application->images()->createMany($images);
            }

            $application->profile()->create([
                'user_id' => $user->id,
                'name_mm' => $profileInfo['name_mm'],
                'name_en' => $profileInfo['name_en'],
                'name_title_mm' => $profileInfo['name_title_mm'],
                'name_title_en' => $profileInfo['name_title_en'],
                'father_name_mm' => $profileInfo['father_name_mm'],
                'father_name_en' => $profileInfo['father_name_en'],
                'father_name_title_mm' => $profileInfo['father_name_title_mm'],
                'father_name_title_en' => $profileInfo['father_name_title_en'],
                'mother_name_mm' => $profileInfo['mother_name_mm'],
                'mother_name_en' => $profileInfo['mother_name_en'],
                'mother_name_title_mm' => $profileInfo['mother_name_title_mm'],
                'mother_name_title_en' => $profileInfo['mother_name_title_en'],
                'nrc_mm' => json_encode([
                    'nrc_region_mm' => !empty($profileInfo['nrc_region_mm']) ? $profileInfo['nrc_region_mm'] : '',
                    'nrc_township_mm' => !empty($profileInfo['nrc_township_mm']) ? $profileInfo['nrc_township_mm'] : '',
                    'nrc_type_mm' => !empty($profileInfo['nrc_type_mm']) ? $profileInfo['nrc_type_mm'] : '',
                    'nrc_number_mm' => !empty($profileInfo['nrc_number_mm']) ? $profileInfo['nrc_number_mm'] : '',
                ]),
                'nrc_en' => json_encode([
                    'nrc_region_en' => !empty($profileInfo['nrc_region_en']) ? $profileInfo['nrc_region_en'] : '',
                    'nrc_township_en' => !empty($profileInfo['nrc_township_en']) ? $profileInfo['nrc_township_en'] : '',
                    'nrc_type_en' => !empty($profileInfo['nrc_type_en']) ? $profileInfo['nrc_type_en'] : '',
                    'nrc_number_en' => !empty($profileInfo['nrc_number_en$']) ? $profileInfo['nrc_number_en$'] : ''
                ]),

                'father_death_status' => $profileInfo['father_death_status'],
                'mother_death_status' => $profileInfo['mother_death_status'],

                'father_nrc_mm' => json_encode([
                    'father_nrc_region_mm' => $profileInfo['father_nrc_region_mm'],
                    'father_nrc_township_mm' => $profileInfo['father_nrc_township_mm'],
                    'father_nrc_type_mm' => $profileInfo['father_nrc_type_mm'],
                    'father_nrc_number_mm' => $profileInfo['father_nrc_number_mm']
                ]),
                'father_nrc_en' => json_encode([
                    'father_nrc_region_en' => $profileInfo['father_nrc_region_en'],
                    'father_nrc_township_en' => $profileInfo['father_nrc_township_en'],
                    'father_nrc_type_en' => $profileInfo['father_nrc_type_en'],
                    'father_nrc_number_en' => $profileInfo['father_nrc_number_en']
                ]),
                'mother_nrc_mm' => json_encode([
                    'mother_nrc_region_mm' => $profileInfo['mother_nrc_region_mm'],
                    'mother_nrc_township_mm' => $profileInfo['mother_nrc_township_mm'],
                    'mother_nrc_type_mm' => $profileInfo['mother_nrc_type_mm'],
                    'mother_nrc_number_mm' => $profileInfo['mother_nrc_number_mm']
                ]),
                'mother_nrc_en' => json_encode([
                    'mother_nrc_region_en' => $profileInfo['mother_nrc_region_en'],
                    'mother_nrc_township_en' => $profileInfo['mother_nrc_township_en'],
                    'mother_nrc_type_en' => $profileInfo['mother_nrc_type_en'],
                    'mother_nrc_number_en' => $profileInfo['mother_nrc_number_en']
                ]),
                'race' => $profileInfo['race'],
                'father_race' => $profileInfo['father_race'],
                'mother_race' => $profileInfo['mother_race'],
                'religion' => $profileInfo['religion'],
                'father_religion' => $profileInfo['father_religion'],
                'mother_religion' => $profileInfo['mother_religion'],
                'date_of_birth' => $profileInfo['date_of_birth'],
                'father_date_of_birth' => !empty($profileInfo['father_date_of_birth']) ? $profileInfo['father_date_of_birth'] : '',
                'mother_date_of_birth' => !empty($profileInfo['mother_date_of_birth']) ? $profileInfo['mother_date_of_birth'] : '',
                'job' => $profileInfo['job'],
                'father_job' => !empty($profileInfo['father_job']) ? $profileInfo['father_job'] : '',
                'mother_job' => !empty($profileInfo['mother_job']) ? $profileInfo['mother_job'] : '',
                'contact_phone' => $profileInfo['contact_phone'],
                'father_contact_phone' => !empty($profileInfo['father_contact_phone']) ? $profileInfo['father_contact_phone'] : '',
                'mother_contact_phone' => !empty($profileInfo['mother_contact_phone']) ? $profileInfo['mother_contact_phone'] : '',
                'father_email' => !empty($profileInfo['father_email']) ? $profileInfo['father_email'] : '',
                'mother_email' => !empty($profileInfo['mother_email']) ? $profileInfo['mother_email'] : '',
                'address' => !empty($profileInfo['address']) ? $profileInfo['address'] : '',
                'father_address' => !empty($profileInfo['father_address']) ? $profileInfo['address'] : '',
                'mother_address' => !empty($profileInfo['mother_address']) ? $profileInfo['address'] : '',
            ]);

            DB::commit();
            $request->session()->forget(['matriculation_detail', 'profile_information']);

            $regSuccessInfo = [
                'submit_option' => $imageUploads['submit_option'],
                'application_code' => $application->code,
                'email' => $user->email,
                'password' => $randomPassword,
            ];
            return view('reg_success', compact('regSuccessInfo'));

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::error('Registration Exception: ' . $e);
            return redirect()->route('entrance.matriculation-detail-form');
        }
    }

    private function randomPassword(
        $length,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ) {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }

        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }

        return $str;
    }
}
