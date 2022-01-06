@extends('layouts.admin')

@section('title', 'ဘာသာတွဲတည်းဖြတ်ခြင်း')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">

                <form id="quickForm" action="{{ route('admin.studies.update', $study->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">ဘာသာတွဲ</label>
                            <input type="hidden" name='id' value="{{ $study->id }}">
                            <input type="text" name="name" class="form-control" value="{{ $study->name }}" id="name"
                                placeholder="ဘာသာတွဲအမည်... ဥပမာ - ဘာသာတွဲ - ၁">

                            @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>

                        <div class="form-group mt-4">
                            <label>တက္ကသိုလ်ဝင်တန်းဆိုင်ရာ ဘာသာတွဲ</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input type=radio class="form-check-input" name="is_matriculation"
                                        id="{{ $study->id }}" value="1"
                                        {{ $study->is_matriculation == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $study->id }}">
                                        ဟုတ်
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type=radio class="form-check-input" name="is_matriculation"
                                        id="{{ $study->id }}" value="0"
                                        {{ $study->is_matriculation == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $study->id }}">
                                        မဟုတ်
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="subject-div form-group mt-4">
                            <div class="col-sm-10">
                                <label for="name">ဘာသာတွဲ၌ ပါဝင်သော ဘာသာရပ်</label>

                                @if (!empty($subjects))
                                    <div class="col-sm-12">
                                        @foreach ($subjects as $key => $value)
                                            <div class="col-sm-6 mb-2">
                                                <input type="checkbox" name="subjects[][subject_id]"
                                                    value="{{ $key }}" @if (in_array($key, $selectedSubjects)) checked @endif>
                                                {{ $value }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">သိမ်းဆည်းမည်</button>
                <a href="{{ url()->previous() }}" class="btn btn-default">နောက်သို့</a>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="{{ asset('plugins') }}/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ asset('plugins') }}/jquery-validation/additional-methods.min.js"></script>
<script>
    $(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                $('#quickForm').get(0).submit();
            }
        });
        $('#quickForm').validate({
            rules: {
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "ကျေးဇူးပြု၍ ဘာသာတွဲအမည်ကို ထည့်သွင်းပါ။"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endpush
