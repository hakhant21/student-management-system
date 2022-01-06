@extends('layouts.admin')

@section('title', 'ငွေစာရင်းတောင်းခံခြင်း အသစ်ဖန်တီး')

@section('content')
<div class="container">
    <div class="col-md-10 mx-auto">
        <div class="card">

            <form action="{{ route('admin.invoices.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-row mt-5">
                        <div class="form-group col-md-5">
                            <label for="inputStudent">ကျောင်းသား/သူ</label>
                            <select name="user_id" class="form-control" required>
                                <option>....</option>
                                @foreach ($users as $user)
                                    @if (old('user_id') and old('user_id') == $user->id)
                                        <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                                    @elseif ($invoice->user_id == $user->id)
                                        <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif

                                @endforeach
                            </select>
                            @if ($errors->has('user_id'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>

                        <div class="form-group col-md-5">
                            <label for="inputDate">ပြေစာရက်စွဲ</label>
                            <input type="date" class="form-control" name="invoice_date" value="{{ $invoice->invoiced_at }}" required>
                            @if ($errors->has('invoice_date'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputType">ပြေစာအမျိုးအစား</label>
                            <select name="invoice_type" class="form-control" id="validationCustom03" required>
                                <option value="">---</option>
                                <option value="0" {{ $invoice->invoice_type == 0? 'selected' : '' }}>Enrollment</option>
                                <option value="1" {{ $invoice->invoice_type == 1? 'selected' : '' }}>Other</option>
                            </select>
                            @if ($errors->has('invoice_type'))
                                <p class="text-danger">{{ $errors->first() }}</p>
                            @endif
                        </div>
                    </div>

                    @if ($details->count() > 0)
                        @foreach ($details as $key => $value)
                            <input type="hidden" name="details[{{ $key }}][id]" value="{{ $value->id }}">
                            <div class="form-row mt-4 detail-div" data-counter="{{ $key }}">
                                <div class="form-group col-md-5">
                                    <label>ပစ္စည်းအမည်</label>
                                    <input type="text" name="details[{{ $key }}][item]" class="form-control" value="{{ $value->item }}" required>
                                    @if ($errors->has('details.{{ $key }}.item'))
                                        <p class="text-danger">{{ $errors->first() }}</p>
                                    @endif
                                </div>

                                <div class="form-group col-md-5">
                                    <label>ကုန်ကျစရိတ်</label>
                                    <input type="text" name="details[{{ $key }}][cost]" class="form-control" value="{{ $value->cost }}" required>
                                    @if ($errors->has('details.{{ $key }}.cost'))
                                        <p class="text-danger">{{ $errors->first() }}</p>
                                    @endif
                                </div>

                                @if ($key == $details->count() - 1)
                                    <div class="form-group col-md-2 add-detail-div">
                                        <label for="" class="mt-3"></label>
                                        <button type="button" class="btn btn-success form-control" id="add-invoice">+</button>
                                    </div>
                                @else
                                    <div class="form-group col-md-2 delete-detail-div">
                                        <label for="" class="mt-3"></label>
                                        <button type="button" class="btn btn-danger form-control" id="delete-invoice">-</button>
                                    </div>
                                @endif

                            </div>
                        @endforeach
                    @endif

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
    });
</script>
@endpush
