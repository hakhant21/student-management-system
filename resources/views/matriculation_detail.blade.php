@extends('layouts.app')

@section('title', 'ကျောင်းသားစီမံခန့်ခွဲမှုစနစ်')

@push('styles')
<style>
    .form-control {
        font-size: 12px;

    }

    .btn-xs {
        font-size: 12px;
    }

    .custom-font label {
        font-size: 12px;
    }

    .card {
        border-radius: 15px;
        border: 2px dashed #dddddd;
    }
    /* strong{
        color: rgb(31, 24, 122);
    } */
</style>
@endpush

@section('content')
    @php
        if(!empty($oldData))
            foreach ($oldData as $key => $value)
                old($key) = $value;
            endforeach
        endif
    @endphp

    <div class="container">
        <div class="col-md-10 mx-auto">
            <form action="{{ route('entrance.save') }}" method="POST">
                @csrf
                <input type="hidden" name="form_name" value="matriculation_detail">

                <div class="form-group row mt-3">
                    <label for="entrance_number" class="col-2 col-sm-3 form-label text-dark">
                        <strong>ဝင်ခွင့်လျှောက်လွှာနံပါတ်</strong>
                    </label>

                    <div class="col-4 col-sm-6">
                        <input type="text" name="entrance_number" class="form-control" id="entrance_number" disabled>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <strong>တက္ကသိုလ်စာမေးပွဲအောင်မြင်ခဲ့သည့်</strong>
                        </h5>

                        <div class="row">
                            <div class="col-md-6 custom-font px-4">
                                <div class="form-group row">
                                    <label for="roll_number" class="col-sm-4 col-form-label text-dark">ခုံအမှတ်
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="roll_number" class="form-control" id="roll_number" value="{{ old('roll_number') ? old('roll_number') : '' }}" required oninvalid="setCustomValidity('ကျေးဇူးပြု၍ ခုံအမှတ် ထည့်သွင်းပါ။')" oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="examination_department" class="col-sm-4 col-form-label text-dark">စာစစ်ဌာန
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        @if(!empty($examDeparts))
                                            <select name="examination_department_id" id="examination_department_id" class="form-control form-control-sm" required oninvalid="setCustomValidity('ကျေးဇူးပြု၍ စာစစ်ဌာန ထည့်သွင်းပါ။')" oninput="setCustomValidity('')">
                                                <option value="">----</option>
                                                @foreach ($examDeparts as $key => $value)
                                                    @if(old('examination_department_id') == $key)
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="year" class="col-sm-4 col-form-label text-dark">ခုနှစ်
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        @if(!empty($years))
                                            <select name="year" id="year" class="form-control form-control-sm" required oninvalid="setCustomValidity('ကျေးဇူးပြု၍ ခုနှစ် ထည့်သွင်းပါ။')" oninput="setCustomValidity('')">
                                                <option value="">----</option>
                                                @foreach ($years as $key => $value)
                                                    @if (old('year') == $key)
                                                        <option value="{{ $value }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $value }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="study_id" class="col-sm-4 col-form-label text-dark">ဘာသာတွဲ
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        @if(!empty($studies))
                                            <select name="study_id" id="study_id" class="form-control form-control-sm" required oninvalid="setCustomValidity('ကျေးဇူးပြု၍ ဘာသာတွဲ ထည့်သွင်းပါ။')" oninput="setCustomValidity('')">
                                                <option value="">----</option>
                                                @foreach ($studies as $key => $value)
                                                    @if(old('study_id') == $key)
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 px-4" id="matriculation-subjects-div">

                                @if(!empty($subjects))
                                    @foreach ($subjects as $key => $value)
                                        <div class="mark-div form-group row d-none" data-mark-id="{{ $key }}">
                                            <label class="col-sm-4 col-form-label text-dark">
                                                {{ $value }}<span class="text-danger">*</span>
                                            </label>

                                            <div class="col-sm-8">
                                                <input type="number" name="matriculation_marks[{{ $key }}]" value="{{ old('matriculation_marks.$key') ? 'matriculation_marks' : '' }}" class="form-control form-control-sm mark-input" min="0" max="100" required oninvalid="setCustomValidity('ကျေးဇူးပြု၍ ရမှတ် ထည့်သွင်းပါ။')" oninput="setCustomValidity('')">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div class="form-group custom-font row">
                                    <label for="totalMarks" class="col-sm-4 col-form-label text-dark">အမှတ်ပေါင်း</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="totalMarks" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><strong>သင်ကြားလိုသည့်ဘာသာရပ်အလိုက်ဦးစားပေးလျှောက်ထားမှု</strong></h5>
                        <div class="row">
                            <div class="col-md-6 custom-font">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-dark">ပထမဦးစားပေး
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        @if(!empty($uniStudies))
                                            <select name="prioritized_studies[0]" class="form-control form-control-sm" required oninvalid="setCustomValidity('ကျေးဇူးပြု၍ ဦးစားပေးဘာသာတွဲကို ထည့်သွင်းပါ။')" oninput="setCustomValidity('')">
                                                <option value="">----</option>
                                                @foreach ($uniStudies as $key => $value)
                                                    @if(old('prioritized_studies') == $key)
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="second_priority" class="col-sm-4 col-form-label text-dark">ဒုတိယဦးစားပေး
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        @if(!empty($uniStudies))
                                            <select name="prioritized_studies[1]" class="form-control form-control-sm" required oninvalid="setCustomValidity('ကျေးဇူးပြု၍ ဒုတိယဦးစားပေးဘာသာတွဲကို ထည့်သွင်းပါ။')" oninput="setCustomValidity('')">
                                                <option value="">----</option>
                                                @foreach ($uniStudies as $key => $value)
                                                    @if (old('prioritized_studies') == $key)
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group custom-font row">
                                    <label for="third_priority" class="col-sm-4 col-form-label text-dark">တတိယဦးစားပေး
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        @if(!empty($uniStudies))
                                            <select name="prioritized_studies[2]" class="form-control form-control-sm" required oninvalid="setCustomValidity('ကျေးဇူးပြု၍ တတိယဦးစားပေးဘာသာတွဲကို ထည့်သွင်းပါ။')" oninput="setCustomValidity('')">
                                                <option value="">----</option>
                                                @foreach ($uniStudies as $key => $value)
                                                    @if (old('prioritized_studies') == $key)
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group custom-font row">
                                    <label for="four_priority" class="col-sm-4 col-form-label text-dark">စတုတ္ထဦးစားပေး
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-8">
                                        @if(!empty($uniStudies))
                                            <select name="prioritized_studies[3]" class="form-control form-control-sm" required oninvalid="setCustomValidity('ကျေးဇူးပြု၍ စတုတ္ထဦးစားပေးဘာသာတွဲကို ထည့်သွင်းပါ။')" oninput="setCustomValidity('')">
                                                <option value="">----</option>
                                                @foreach ($uniStudies as $key => $value)
                                                    @if (old('prioritized_studies') == $key)
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="float-right mb-lg-5">
                    <button type="submit" class="btn btn-primary btn-xs">နောက်တမျက်နှာသို့</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(function () {

    var studies = {!! json_encode($studiesWithSubjects) !!};
    $('#study_id').change(function () {
        $('.mark-div').addClass('d-none');
        $('.mark-input').prop('required', false);
        subjects = studies[$(this).val()];
        if (subjects.length > 0) {
            subjects.forEach(function (value, index, array) {
                $('#matriculation-subjects-div').find("[data-mark-id='" + value + "']").removeClass('d-none');
                $('#matriculation-subjects-div').children("[data-mark-id='" + value + "']").find('.mark-input').prop('required', true).removeAttr('oninvalid').removeAttr('oninput');
            });
        }
    });

    $('.mark-input').blur(function () {
        totalMarks = 0;
        $('.mark-input').each(function(index) {
            totalMarks = Number(totalMarks) + Number($(this).val());
        });
        $('#totalMarks').val(totalMarks);

    });
});
</script>
@endpush
