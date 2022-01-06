@extends('layouts.admin')

@section('title', 'ဆက်တင်များ')

@push('styles')
    <style type="text/css">
        img.thumbnail {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }

        img.thumbnail:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }

    </style>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/image-uploader.min.css') }}">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/image-uploader.min.js') }}"></script>
@endpush

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">

                @if (empty($setting))
                    <form id="quickForm" action="{{ route('admin.settings.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="app_name">အက်ပ်အမည်</label>
                                <input type="text" name="app_name" value="{{ old('app_name') ? old('app_name') : '' }}"
                                    class="form-control" id="app_name" placeholder="အက်ပ်အမည်">

                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">အီးမေးလိပ်စာ</label>
                                <input type="email" name="email" value="{{ old('email') ? old('email') : '' }}"
                                    class="form-control" id="email" placeholder="အီးမေးလိပ်စာ">

                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="logo">အမှတ်တံဆိပ်</label>
                                <input type="file" name="logo" value="{{ old('logo') ? old('logo') : '' }}"
                                    class="form-control" id="logo">

                                @if ($errors->has('logo'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="logo">လက်မှတ်</label>
                                <input type="file" name="digital_signature" value="{{ old('digital_signature') ? old('digital_signature') : '' }}"
                                    class="form-control" id="digital_signature">

                                @if ($errors->has('digital_signature'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">ဖုန်း</label>
                                <input type="text" name="phone" value="{{ old('phone') ? old('phone') : '' }}"
                                    class="form-control" id="phone" placeholder="ဖုန်း">

                                @if ($errors->has('phone'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address">လိပ်စာ</label>
                                <input type="text" name="address" value="{{ old('address') ? old('address') : '' }}"
                                    class="form-control" id="address" placeholder="လိပ်စာ">

                                @if ($errors->has('address'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="google_map_iframe">မြေပုံ (Google Map Iframe)</label>
                                <textarea name="google_map_iframe"
                                    value="{{ old('google_map_iframe') ? old('google_map_iframe') : '' }}"
                                    class="form-control" id="google_map_iframe"></textarea>

                                @if ($errors->has('google_map_iframe'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="copyright_info">မူပိုင်ခွင့်</label>
                                <input type="text" name="copyright_info"
                                    value="{{ old('copyright_info') ? old('copyright_info') : '' }}"
                                    class="form-control" id="copyright_info"
                                    placeholder="Copyright © YYYY-YYYY Organization Name">

                                @if ($errors->has('copyright_info'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="copyright_info">ဆလိုက်များ</label>
                                <div class="input-images-1"></div>

                                @if ($errors->has('images'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">သိမ်းဆည်းမည်</button>
                            <a href="{{ url()->previous() }}" class="btn btn-default">နောက်သို့</a>
                        </div>
                    </form>

                    @push('scripts')

                        <script src="{{ asset('plugins') }}/jquery-validation/jquery.validate.min.js"></script>
                        <script src="{{ asset('plugins') }}/jquery-validation/additional-methods.min.js"></script>
                        <script>
                            $(function() {

                                // Image Uploader
                                $('.input-images-1').imageUploader({
                                    lable: 'ပုံများကိုဆွဲယူ၍ချပါ သို့မဟုတ် browseလုပ်ရန်နှိပ်ပါ',
                                });

                                $.validator.setDefaults({
                                    submitHandler: function() {
                                        $('#quickForm').get(0).submit();
                                    }
                                });
                                $('#quickForm').validate({
                                    rules: {
                                        app_name: {
                                            required: true
                                        },
                                        email: {
                                            required: true,
                                            email: true
                                        },
                                        address: {
                                            required: true
                                        },
                                        phone: {
                                            required: true
                                        },
                                        logo: {
                                            required: true
                                        },
                                        copyright_info: {
                                            required: true
                                        },
                                        digital_signature: {
                                            required: true
                                        }

                                    },
                                    messages: {
                                        app_name: {
                                            required: "ကျေးဇူးပြု၍ အက်ပ်အမည်ကို ထည့်သွင်းပါ။"
                                        },
                                        email: {
                                            required: "ကျေးဇူးပြု၍ အီးမေးလ်လိပ်စာထည့်ပါ။",
                                            email: "ကျေးဇူးပြု၍ တရားဝင်အီးမေးလ်လိပ်စာကို ထည့်ပါ။"
                                        },
                                        address: {
                                            required: "ကျေးဇူးပြု၍ လိပ်စာကို ထည့်သွင်းပါ။"
                                        },
                                        phone: {
                                            required: "ကျေးဇူးပြု၍ ဖုန်းကို ထည့်သွင်းပါ။"
                                        },
                                        logo: {
                                            required: "ကျေးဇူးပြု၍ အမှတ်တံဆိပ်ကို ထည့်သွင်းပါ။"
                                        },
                                        copyright_info: {
                                            required: "ကျေးဇူးပြု၍ မူပိုင်ခွင့်ကို ထည့်သွင်းပါ။"
                                        },
                                        digital_signature: {
                                            required: "ကျေးဇူးပြု၍ လက်မှတ်ကို ထည့်သွင်းပါ။"
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

                @else

                    <form id="quickForm" action="{{ route('admin.settings.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="form-group">
                                <label for="app_name">အက်ပ်အမည်</label>
                                <input type="text" name="app_name" value="{{ $setting->app_name }}"
                                    class="form-control" id="app_name" placeholder="အက်ပ်အမည်">

                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">အီးမေးလိပ်စာ</label>
                                <input type="email" name="email" value="{{ $setting->email }}" class="form-control"
                                    id="email" placeholder="အီးမေးလိပ်စာ">

                                @if ($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="logo">အမှတ်တံဆိပ်</label>

                                <a target="_blank" href="{{ asset($setting->logo) }}"
                                    class="d-block mb-2">
                                    <img src="{{ asset($setting->logo) }}" alt="Logo"
                                        style="width:150px" class="thumbnail">
                                </a>

                                <input type="file" name="logo" class="form-control" id="logo">

                                @if ($errors->has('logo'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">ဖုန်း</label>
                                <input type="text" name="phone" value="{{ $setting->phone }}" class="form-control"
                                    id="phone" placeholder="ဖုန်း">

                                @if ($errors->has('phone'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address">လိပ်စာ</label>
                                <input type="text" name="address" value="{{ $setting->address }}"
                                    class="form-control" id="address" placeholder="လိပ်စာ">

                                @if ($errors->has('address'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="google_map_iframe">မြေပုံ (Google Map Iframe)</label>
                                <textarea name="google_map_iframe" class="form-control" id="google_map_iframe">
                                    {!! $setting->google_map_iframe !!}
                                </textarea>

                                @if ($errors->has('google_map_iframe'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="digital_signature">လက်မှတ်</label>

                                @if (!empty($setting->digital_signature))
                                    <a target="_blank" href="{{ asset($setting->digital_signature) }}" class="d-block mb-2">
                                        <img src="{{ asset($setting->digital_signature) }}" alt="digital_signature"
                                            style="width:150px" class="thumbnail">
                                    </a>
                                @endif

                                <input type="file" name="digital_signature" class="form-control" id="digital_signature">

                                @if ($errors->has('digital_signature'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="copyright_info">မူပိုင်ခွင့်</label>
                                <input type="text" name="copyright_info" value="{{ $setting->copyright_info }}"
                                    class="form-control" id="copyright_info"
                                    placeholder="Copyright © YYYY-YYYY Organization Name">

                                @if ($errors->has('copyright_info'))
                                    <p class="text-danger">{{ $errors->first() }}</p>
                                @endif
                            </div>

                            @if (count($sliders) > 0)
                                <div class="form-group">
                                    <label for="copyright_info">ဆလိုက်အဟောင်းများဖျက်ရန်</label>
                                    <div class="input-field">
                                        <div class="input-images-2"></div>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="copyright_info">ဆလိုက်အသစ်များတင်ရန်</label>
                                <div class="input-field">
                                    <div class="input-images-1"></div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">သိမ်းဆည်း</button>
                            <a href="{{ url()->previous() }}" class="btn btn-default">နောက်ကြောင်းပြန်</a>
                        </div>
                    </form>

                    @push('scripts')
                        <!-- jquery-validation -->
                        <script src="{{ asset('plugins') }}/jquery-validation/jquery.validate.min.js"></script>
                        <script src="{{ asset('plugins') }}/jquery-validation/additional-methods.min.js"></script>
                        <script>
                            $(function() {

                                // Image Uploader
                                let preloaded = <?php echo json_encode($sliders); ?>;
                                $('.input-images-2').imageUploader({
                                    lable: 'ပုံများကိုဆွဲယူ၍ချပါ သို့မဟုတ် browse လုပ်ရန်နှိပ်ပါ',
                                    preloaded: preloaded,
                                    imagesInputName: 'photos',
                                    preloadedInputName: 'old_images'
                                });

                                $('.input-images-1').imageUploader({
                                    lable: 'ပုံများကိုဆွဲယူ၍ချပါ သို့မဟုတ် browse လုပ်ရန်နှိပ်ပါ',
                                    imagesInputName: 'images'
                                });

                                $.validator.setDefaults({
                                    submitHandler: function() {
                                        $('#quickForm').get(0).submit();
                                    }
                                });
                                $('#quickForm').validate({
                                    rules: {
                                        app_name: {
                                            required: true
                                        },
                                        email: {
                                            required: true,
                                            email: true
                                        },
                                        address: {
                                            required: true
                                        },
                                        phone: {
                                            required: true
                                        },
                                        copyright_info: {
                                            required: true
                                        }

                                    },
                                    messages: {
                                        app_name: {
                                            required: "ကျေးဇူးပြု၍ အက်ပ်အမည်ကို ထည့်သွင်းပါ။"
                                        },
                                        email: {
                                            required: "ကျေးဇူးပြု၍ အီးမေးလ်လိပ်စာထည့်ပါ။",
                                            email: "ကျေးဇူးပြု၍ တရားဝင်အီးမေးလ်လိပ်စာကို ထည့်ပါ။"
                                        },
                                        address: {
                                            required: "ကျေးဇူးပြု၍ လိပ်စာကို ထည့်သွင်းပါ။"
                                        },
                                        phone: {
                                            required: "ကျေးဇူးပြု၍ ဖုန်းကို ထည့်သွင်းပါ။"
                                        },
                                        copyright_info: {
                                            required: "ကျေးဇူးပြု၍ မူပိုင်ခွင့်ကို ထည့်သွင်းပါ။"
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
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
