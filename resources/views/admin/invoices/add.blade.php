@extends('layouts.admin')

@section('title', 'ငွေစာရင်းတောင်းခံခြင်း အသစ်ဖန်တီး')

@section('content')
<div class="container">
    <div class="col-md-10 mx-auto">
        <div class="card">

            <form action="{{ route('admin.invoices.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row mt-5">
                        <div class="form-group col-md-5">
                            <label for="inputStudent">ကျောင်းသား/သူ</label>
                            <select name="user_id" class="form-control" required>
                                <option>....</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_id'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>

                        <div class="form-group col-md-5">
                            <label for="inputDate">ပြေစာရက်စွဲ</label>
                            <input type="date" class="form-control" name="invoice_date" required>
                            @if ($errors->has('invoice_date'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputType">ပြေစာအမျိုးအစား</label>
                            <select name="invoice_type" class="form-control" id="validationCustom03" required>
                                <option value="">---</option>
                                <option value="0">Enrollment</option>
                                <option value="1">Other</option>
                            </select>
                            @if ($errors->has('invoice_type'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-row mt-4 detail-div" data-counter="0">
                        <div class="form-group col-md-5">
                            <label>ပစ္စည်းအမည်</label>
                            <input type="text" name="details[0][item]" class="form-control" required>
                            @if ($errors->has('details.*.item'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>

                        <div class="form-group col-md-5">
                            <label>ကုန်ကျစရိတ်</label>
                            <input type="text" name="details[0][cost]" class="form-control" required>
                            @if ($errors->has('details.*.cost'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>

                        <div class="form-group col-md-2 add-detail-div">
                            <label for="" class="mt-3"></label>
                            <button type="button" class="btn btn-success form-control" id="add-invoice">+</button>
                        </div>
                    </div>

                    <div class="form-row mt-4">
                        <div class="col-md-2">
                            <input type="submit" value="OK" class="btn btn-success form-control">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $(document).on('click', '#add-invoice', function () {
            newDetailDiv = $('.detail-div:last').clone();
            $('.detail-div:last')
                .find('.add-detail-div')
                    .removeClass('add-detail-div')
                    .addClass('delete-detail-div')
                        .find('button')
                        .html('-')
                        .removeClass('btn-success')
                        .addClass('btn-danger')
                        .removeAttr('id')
                        .attr('id', 'delete-invoice');

            // Update Counter of Elements
            oldCounter = parseInt(newDetailDiv.attr('data-counter'));
            newCounter = oldCounter + 1;
            newDetailDiv.attr('data-counter', newCounter);

            $(newDetailDiv.find('input')).each(function() {
                oldFieldName = $(this).attr('name');
                newFieldName = oldFieldName.replace('[' + oldCounter + ']', '[' + newCounter + ']');
                $(this).attr('name', newFieldName);
            });

            newDetailDiv.insertAfter('.detail-div:last');
        });

        $(document).on('click', '#delete-invoice', function () {
            $(this).parents('.detail-div').remove();
        });
    });
</script>
@endpush
