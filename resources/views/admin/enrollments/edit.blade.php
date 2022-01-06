@extends('layouts.admin')

@section('title', 'စာရင်းသွင်းခြင်း')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <form id="quickForm" action="{{ route('admin.enrollments.update', $enrollment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">ကျောင်းသား/သူ <span class="text-danger">*</span></label>

                            <select class="form-control" name="user_id" required>
                                <option value="">ရွေးချယ်ပါ။</option>
                                @foreach ($users as $key => $value)

                                    @if (old('user_id'))
                                        <option value="{{ $key }}"
                                            {{ old('user_id') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @else
                                        <option value="{{ $key }}"
                                            {{ $enrollment->user_id == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            @if ($errors->has('user_id'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">ပညာသင်နှစ် <span class="text-danger">*</span></label>

                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control" name="academic_year_from" required>
                                        @for ($i = date('Y'); $i >= 1988; $i--)

                                            @if (old('academic_year_from'))
                                                <option value="{{ $i }}"
                                                    {{ old('academic_year_from') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @else
                                                <option value="{{ $i }}"
                                                    {{ $enrollment->academic_year_from == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endif
                                        @endfor
                                    </select>

                                    @if ($errors->has('academic_year_from'))
                                        <p class="text-danger">{{ $errors->first() }}</p>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <select class="form-control" name="academic_year_to" required>
                                        @for ($i = date('Y') + 1; $i >= 1988; $i--)

                                            @if (old('academic_year_to'))
                                                <option value="{{ $i }}"
                                                    {{ old('academic_year_to') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @else
                                                <option value="{{ $i }}"
                                                    {{ $enrollment->academic_year_to == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endif
                                        @endfor
                                    </select>

                                    @if ($errors->has('academic_year_to'))
                                        <p class="text-danger">{{ $errors->first() }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">ခုံအမှတ်</label>

                            <input type="text" name="roll_number" class="form-control"
                                value="{{ old('roll_number') ? old('roll_number') : $enrollment->roll_number }}">

                            @if ($errors->has('roll_number'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
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
                user_id: {
                    required: true
                },
                academic_year_from: {
                    required: true
                },
                academic_year_to: {
                    required: true
                }
            },
            messages: {
                user_id: {
                    required: "ကျေးဇူးပြု၍ ကျောင်းသား/သူကို ထည့်သွင်းပါ။"
                },
                academic_year_from: {
                    required: "ကျေးဇူးပြု၍ ပညာသင်နှစ်ကို ထည့်သွင်းပါ။"
                },
                academic_year_to: {
                    required: "ကျေးဇူးပြု၍ ပညာသင်နှစ်ကို ထည့်သွင်းပါ။"
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
