@extends('layouts.admin')

@section('title', 'ငွေတောင်းခံလွှာအမျိုးအစားတည်းဖြတ်ခြင်း')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">

                <form id="quickForm"
                    action="{{ route('admin.invoice_types.update', $invoice_type->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">ငွေတောင်းခံလွှာအမျိုးအစား</label>
                            <input type="text" name="name" class="form-control" value="{{ $invoice_type->name }}" id="name" placeholder="ငွေတောင်းခံလွှာအမျိုးအစားအမည်... ">

                            @if ($errors->has('name'))
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
                    required: "ကျေးဇူးပြု၍ ငွေတောင်းခံလွှာအမျိုးအစားအမည်ကို ထည့်သွင်းပါ။"
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
