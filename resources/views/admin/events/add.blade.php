@extends('layouts.admin')

@section('title', 'ပွဲများ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">

                <form id="quickForm" action="{{ route('admin.events.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">ပွဲ</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="ပွဲအမည်" value="{{ old('name') }}">

                            @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="from">စတင်သည့်နေ့စွဲ</label>
                            <input type="date" name="from" class="form-control" id="from" value="{{ old('from') }}">

                            @if ($errors->has('from'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="to">ပြီးဆုံးမည့်ရက်စွဲ</label>
                            <input type="date" name="to" class="form-control" id="to" value="{{ old('to') }}">

                            @if ($errors->has('to'))
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
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "ကျေးဇူးပြု၍ ဓာတ်ပုံအမျိုးအစားအမည်ကို ထည့်သွင်းပါ။"
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
