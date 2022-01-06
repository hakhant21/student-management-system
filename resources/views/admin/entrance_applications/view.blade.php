@extends('layouts.admin')

@section('title', 'ကျောင်းသားစီမံခန့်ခွဲမှုစနစ်')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins') }}/ekko-lightbox/ekko-lightbox.css">
    <style>
        .custom-card {
            margin: 0 auto;
        }

        .card-body {
            font-size: 12px;
        }

        .list-group-item {
            padding: 0.75rem 0rem;
        }

    </style>
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">

        @if ($entrance_application->status == 1)
            @if (empty($entrance_application->user->confirmedStudy))
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">ဘာသာရပ်အတည်ပြုရန်</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <form class="form-inline"
                                    action="{{ route('admin.entrance_applications.confirm-study', $entrance_application->id) }}"
                                    method="POST">
                                    @csrf

                                    <div class="custom-form-group ml-2">
                                        <label class="col-form-label text-dark adjust_label">Subject
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select class="form-control" name="study" required>
                                            @foreach ($prioritizedSubjects as $key => $value)
                                                <option value="{{ $value->study_id }}">
                                                    {{ $value->study->name }} ( {{ $value->priority_mm }})
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('study'))
                                            <p class="text-danger">{{ $errors->first() }}</p>
                                        @endif
                                    </div>

                                    <div class="custom-form-group ml-2">
                                        <label class="col-form-label text-dark adjust_label">Academic Year (From)
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select class="form-control" name="academic_year_from" required>
                                            @for ($i = date('Y'); $i >= 1988; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>

                                        @if ($errors->has('academic_year_from'))
                                            <p class="text-danger">{{ $errors->first() }}</p>
                                        @endif
                                    </div>

                                    <div class="custom-form-group ml-2">
                                        <label class="col-form-label text-dark adjust_label">Academic Year (To)
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select class="form-control" name="academic_year_to" required>
                                            @for ($i = date('Y') + 1; $i >= 1988; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>

                                        @if ($errors->has('academic_year_to'))
                                            <p class="text-danger">{{ $errors->first() }}</p>
                                        @endif
                                    </div>

                                    <div class="custom-form-group ml-2">
                                        <label class="col-form-label text-dark adjust_label"></label>
                                        <button type="submit" class="btn btn-primary ml-2">Ok</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else

            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title">အချက်အလက်အတည်ပြုရန်</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <form class="form-inline"
                                action="{{ route('admin.entrance_applications.store-status', $entrance_application->id) }}"
                                method="POST">
                                @csrf
                                <select class="form-control" name="entrance_status" required>
                                    <option value=""> အခြေအနေပြောင်းလဲမည် </option>
                                    <option value="1"> အတည်ပြုမည် </option>
                                    <option value="2"> ငြင်းပယ်မည် </option>
                                </select>

                                <div class="form-group mx-sm-3">
                                    <input type="text" name="remark" class="form-control" id="remark" placeholder="မှတ်ချက်">
                                </div>
                                <button type="submit" class="btn btn-primary">Ok</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (!empty($images))
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title">ဓာတ်ပုံများ</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($images as $image)
                                <div class="col-sm-2">
                                    <a href="{{ asset('storage') . '/' . $image->path }}" data-toggle="lightbox"
                                        data-title="{{ $image->imageType->name }}" data-gallery="gallery">
                                        <img src="{{ asset('storage') . '/' . $image->path }}" class="img-fluid mb-2"
                                            alt="{{ $image->imageType->name }}" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6 custom-card">
                <!-- Matriculation Detail -->
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <p>ကိုယ်ရေးအချက်အလက်</p>
                    </div>

                    <div class="card-body">
                        <div class="tab-pane" id="timeline">
                            <div class="post">
                                <div class="profile-block">
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item">
                                            အမည် (မြန်မာ)
                                            <p class="float-right">{{ $entrance_application->profile->name_mm }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            အမည် (အင်္ဂလိပ်)
                                            <p class="float-right">{{ $entrance_application->profile->name_en }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            နိုင်ငံသားစိစစ်ရေးကတ်ပြားအမှတ် (မြန်မာ)
                                            <p class="float-right">{{ implode('/', $nrc_mm) }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            နိုင်ငံသားစိစစ်ရေးကတ်ပြားအမှတ် (အင်္ဂလိပ်)
                                            <p class="float-right">{{ implode('/', $nrc_en) }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            လူမျိုး
                                            <p class="float-right">{{ $entrance_application->profile->race }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            ကိုးကွယ်သည့်ဘာသာ
                                            <p class="float-right">{{ $entrance_application->profile->religion }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            မွေးသက္ကရာဇ်
                                            <p class="float-right">
                                                {{ $entrance_application->profile->date_of_birth }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            အလုပ်အကိုင်
                                            <p class="float-right">{{ $entrance_application->profile->job }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            ဆက်သွယ်ရန်ဖုန်းနံပါတ်
                                            <p class="float-right">
                                                {{ $entrance_application->profile->contact_phone }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            အီးမေးလ်လိပ်စာ
                                            <p class="float-right">{{ $entrance_application->profile->email }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            ဆက်သွယ်ရန်လိပ်စာ
                                            <p class="float-right">{{ $entrance_application->profile->address }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- <a href="{{ url()->previous() }}" class="btn btn-primary"><b>နောက်သို့</b></a> --}}
                    </div>
                </div>
            </div>

            <!---- Profile Information --->
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <p>တက္ကသိုလ်၀င်တန်းအချက်အလက်</p>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="post">
                                    <div class="profile-block">
                                        <ul class="list-group list-group-flush mb-3">

                                            @foreach ($matriculationDetails as $matriculationDetail)
                                                <li class="list-group-item">
                                                    ခုံအမှတ် <p class="float-right">
                                                        {{ $matriculationDetail->roll_number }}</p>
                                                </li>
                                            @endforeach

                                            <li class="list-group-item">
                                                စာစစ်ဌာန <p class="float-right">{{ $examinationDepartmentName }}
                                                </p>
                                            </li>

                                            @foreach ($matriculationDetails as $matriculationDetail)
                                                <li class="list-group-item">
                                                    ခုနှစ် <p class="float-right">{{ $matriculationDetail->year }}
                                                    </p>
                                                </li>
                                            @endforeach

                                            <li class="list-group-item">
                                                ဘာသာတွဲ <p class="float-right">{{ $studyName }}</p>
                                            </li>

                                            @foreach ($markArray as $marks)
                                                <li class="list-group-item">
                                                    {{ $marks->subject->name }} <p class="float-right">
                                                        {{ $marks->mark }}</p>
                                                </li>
                                            @endforeach

                                            <li class="list-group-item">
                                                အမှတ်ပေါင်း <p class="float-right">{{ $totalMark }}</a>
                                            </li>

                                            @foreach ($prioritizedSubjects as $prioritizedSubject)
                                                <li class="list-group-item">
                                                    {{ $prioritizedSubject->priority_mm }} <p class="float-right">
                                                        {{ $prioritizedSubject->study->name }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 custom-card">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <p>ဖခင်ကိုယ်ရေးအချက်အလက်</p>
                    </div>

                    <div class="card-body">
                        <div class="tab-pane" id="timeline">
                            <div class="post">
                                <div class="profile-block">
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item">
                                            ဖခင်အမည် (မြန်မာ)
                                            <p class="float-right">
                                                {{ $entrance_application->profile->father_name_mm }}
                                            </p>
                                        </li>
                                        <li class="list-group-item">
                                            ဖခင်အမည် (အင်္ဂလိပ်)
                                            <p class="float-right">
                                                {{ $entrance_application->profile->father_name_en }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            နိုင်ငံသားစိစစ်ရေးကတ်ပြားအမှတ် (မြန်မာ)
                                            <p class="float-right">{{ implode('/', $father_nrc_mm) }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            နိုင်ငံသားစိစစ်ရေးကတ်ပြားအမှတ် (အင်္ဂလိပ်)
                                            <p class="float-right">{{ implode('/', $father_nrc_en) }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            လူမျိုး
                                            <p class="float-right">
                                                {{ $entrance_application->profile->father_race }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            ကိုးကွယ်သည့်ဘာသာ
                                            <p class="float-right">
                                                {{ $entrance_application->profile->father_religion }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            မွေးသက္ကရာဇ်
                                            <p class="float-right">
                                                {{ $entrance_application->profile->father_date_of_birth }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            အလုပ်အကိုင်
                                            <p class="float-right">
                                                {{ $entrance_application->profile->father_job }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            ဆက်သွယ်ရန်ဖုန်းနံပါတ်
                                            <p class="float-right">
                                                {{ $entrance_application->profile->father_contact_phone }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            အီးမေးလ်လိပ်စာ
                                            <p class="float-right">
                                                {{ $entrance_application->profile->father_email }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            ဆက်သွယ်ရန်လိပ်စာ
                                            <p class="float-right">
                                                {{ $entrance_application->profile->father_address }}
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 custom-card">
                <div class="card card-primary card-outline">
                    <div class="card-header p-2">
                        <p>မိခင်ကိုယ်ရေးအချက်အလက်</p>
                    </div>
                    <div class="card-body">
                        <div class="tab-pane" id="timeline">
                            <div class="post">
                                <div class="profile-block">
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item">
                                            မိခင်အမည် (မြန်မာ)
                                            <p class="float-right">{{ $entrance_application->profile->mother_name_mm }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            မိခင်အမည် (အင်္ဂလိပ်)
                                            <p class="float-right">
                                                {{ $entrance_application->profile->mother_name_en }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            နိုင်ငံသားစိစစ်ရေးကတ်ပြားအမှတ် (မြန်မာ)
                                            <p class="float-right">{{ implode('/', $mother_nrc_mm) }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            နိုင်ငံသားစိစစ်ရေးကတ်ပြားအမှတ် (အင်္ဂလိပ်)
                                            <p class="float-right">{{ implode('/', $mother_nrc_en) }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            လူမျိုး
                                            <p class="float-right">
                                                {{ $entrance_application->profile->mother_race }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            ကိုးကွယ်သည့်ဘာသာ
                                            <p class="float-right">
                                                {{ $entrance_application->profile->mother_religion }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            မွေးသက္ကရာဇ်
                                            <p class="float-right">
                                                {{ $entrance_application->profile->mother_date_of_birth }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            အလုပ်အကိုင်
                                            <p class="float-right">{{ $entrance_application->profile->mother_job }}</p>
                                        </li>

                                        <li class="list-group-item">
                                            ဆက်သွယ်ရန်ဖုန်းနံပါတ်
                                            <p class="float-right">
                                                {{ $entrance_application->profile->mother_contact_phone }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            အီးမေးလ်လိပ်စာ
                                            <p class="float-right">
                                                {{ $entrance_application->profile->mother_email }}
                                            </p>
                                        </li>

                                        <li class="list-group-item">
                                            ဆက်သွယ်ရန်လိပ်စာ
                                            <p class="float-right">
                                                {{ $entrance_application->profile->mother_address }}
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('plugins') }}/ekko-lightbox/ekko-lightbox.min.js"></script>
<script type="text/javascript">
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });
</script>
@endpush
