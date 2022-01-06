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

    .custom-font {
        font-size: 12px;
    }

    .card {
        border-radius: 15px;
        border: 2px dashed #dddddd;
        padding: 15px;
    }
    /* strong{
            color: rgb(31, 24, 122);
        } */

</style>
@endpush

@section('content')
    <div class="container">
        <div class="col-md-10 mx-auto">
            <form action="{{ route('entrance.save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 card">
                    <div class="card-body">
                        <h6 class="text-danger text-center">* ဓာတ်ပုံများကို jpg, jpeg, png အမျိုးအစားများဖြင့်သာ တင်၍ ရပါမည်။</h6>
                        <div class="row custom-font">
                            <div class="col-md-6 px-4">
                                <div class="form-group row">
                                    <label for="image" class="col-sm-4 col-form-label text-dark">ဓာတ်ပုံ
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-8">
                                        @if(!empty($imageTypes))
                                            <select id="image" name="image" class="form-control form-control-sm">
                                                <option value="">----</option>
                                                @foreach ($imageTypes as $key => $value)
                                                    @if (old('image') == $key)
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

                            <div class="col-md-6 row">
                                <div class="form-group mr-3">
                                    <input type="file" name="" class="form-control form-control-sm" id="file">
                                </div>

                                <div class="form-group">
                                    <button type="button" id="save-img" class="btn btn-success btn-xs">သိမ်းမည်</button>
                                </div>
                            </div>
                        </div>

                        <div class="row custom-font mt-3">
                            <div class="col-md-3">
                                <img src="" class="img-thumbnail" id="img-thumbnail" style="display: none;">
                            </div>

                            <div class="col-md-9">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Description</th>
                                            <th scope="col">Name</th>
                                            <th colspan="2" scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="text-danger">*ဤဝင်ခွင့်လျှောက်လွှာကို 31/12/2021 ရက် မတိုင်မီ စစ်ဆေးပေးပါ။</h6>
                <hr>

                <div class="form-group custom-font row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label" for="terms">
                            <strong>အထက်ပါအချက်အလက်များကို ကျွှန်တော်/ကျွှန်မသည် မှန်ကန်စွာ ဖြည့်စွက်ထားကြောင်း ဝန်ခံကတိပြုပါသည်။</strong>
                        </label>
                    </div>
                </div>

                <div class="float-right mb-lg-5">
                    <button type="submit" class="btn btn-primary btn-xs">ရှေ့သို့</button>
                    <button type="submit" class="btn btn-success btn-xs" name="submit_option" value="save">သိမ်းမည်</button>
                    <button type="submit" class="btn btn-secondary btn-xs" name="submit_option" value="submit">တင်မည်</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {

        imageTypes = {!! json_encode($imageTypes) !!};
        $('#file').prop('disabled', true);
        $('#save-img').prop('disabled', true);

        $('#image').change(function () {
            if ($(this).val() == '') {
                $('#save-img').prop('disabled', true);
                $('#file').prop('disabled', true);
            } else {
                $('#file').prop('disabled', false);
            }
        });

        $('#file').change(function () {
            if ($(this).val() == '') {
                $('#save-img').prop('disabled', true);
            } else {
                $('#save-img').prop('disabled', false);
            }
        });

        $('#save-img').click(function () {
            tbody = $('tbody');

            image = $('#file').val();
            imageType = $('#image').val();
            imageFileName = image.replace(/C:\\fakepath\\/i, '');

            imageFile = $("#file").prop('files')[0];
            imageBlock = '<tr class="image-block" id=image-block-' + imageType + ' data-image-type= ' + imageType + '><input type="hidden" name=images[' + imageType + ']><td scope="row">' + imageTypes[imageType] + '</td><td>' + imageFileName + '</td><td scope="row" class="text-center"><a href="#" class="image-view btn btn-info btn-xs mr-2"><i class="fa fa-eye" aria-hidden="true"></i></a><a href="#" class="image-remove btn btn-warning btn-xs"><i class="fa fa-times" aria-hidden="true"></i></a></td></tr>';
            tbody.append(imageBlock);
            getBase64(imageFile, imageType);

            $('#image').val('');
            $('#file').val('');
            $('option[value=' + imageType + ']').hide();
        });

        $(document).on('click', '.image-view', function () {
            base64Img = $(this).parents('.image-block').find('input').val();
            $('#img-thumbnail').attr('src', base64Img).show();
        });

        $(document).on('click', '.image-remove', function () {
            $('option[value=' + $(this).parents('.image-block').attr('data-image-type') + ']').show();
            $(this).parents('.image-block').remove();
        });

        function getBase64(file, imageType) {
            var reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = function () {
                $('#image-block-' + imageType).find('input').val(reader.result);
            };

            reader.onerror = function (error) {
                console.log('Error: ', error);
            };
        }
    });
</script>
@endpush
