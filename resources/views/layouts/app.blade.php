<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $settings = config('settings');
    @endphp

    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ကျောင်းသားစီမံခန့်ခွဲမှုစနစ်') }} | @yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->

    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css') }}/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('css') }}/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('images') }}/fevicon.png" type="image/gif" />
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap"
        rel="stylesheet">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="{{ asset('css') }}/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">
    <link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=pyidaungsu'>

    <style type="text/css">
        @font-face {
        font-family: 'pyidaungsuregular';
            src: url({{asset('pyidaungsu-webfont.woff2')}}) format('woff2'),
                url({{asset('pyidaungsu-webfont.woff')}}) format('woff');
            font-weight: normal;
            font-style: normal;
        }

        /* .carousel-inner img {
            width: 100%;
            height: 520px;
            display: block;
        } */
        /* .carousel-item .img-fluid {
            width:100%;
            height:100%;
        }
        #demo {
            margin-bottom: 3%;
        } */

    </style>
    @stack('styles')
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        <div class="row">
            <div class="col-sm-8 mx-auto mt-3 mb-3 rounded" style="background: #830303;">
                @if (!empty($settings['address']))
                    <i class="ml-3 text-white fa fa-map-marker"></i> <span
                        class="text-white">{{ $settings['address'] }}</span>
                @endif

                @if (!empty($settings['email']))
                    <i class="ml-3 text-white fa fa-envelope"></i> <span
                        class="text-white">{{ $settings['email'] }}</span>
                @endif

                @if (!empty($settings['phone']))
                    <i class="ml-3 text-white fa fa-phone"></i> <span
                        class="text-white">{{ $settings['phone'] }}</span>
                @endif
            </div>
        </div>
    </div>

    <nav class="navbar navbar-light bg-light">
        @if (!empty($settings['logo']))
            <a class="navbar-brand"><img src="{{ asset($settings['logo']) }}" style="width: 275px;"></a>
        @endif

        <div class="form-inline">
            @auth
                <a href="{{ url('/home') }}" class="btn btn-primary mr-lg-2">ပရိုဖိုင်</a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-default my-2 my-sm-0">ထွက်ရန်</button>
                </form>
            @else
                <a href="{{ route('entrance.form') }}" class="btn btn-primary mr-lg-2">ကျောင်းဝင်ခွင့်လျှောက်ရန်</a>
                <a href="{{ route('login') }}" class="btn btn-outline-success my-2 my-sm-0">အကောင့်ဝင်ရန်</a>
            @endauth
        </div>
    </nav>
    <!-- header section end -->

    @yield('content')

    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="footer_logo">
                        <img src="{{ asset($settings['logo']) }}" style="width: 275px;">
                    </div>
                </div>

                @if (!empty($settings['google_map_iframe']))
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <h4 class="footer_taital">ကျောင်း၏တည်နေရာ</h4>
                        <div class="map">
                            {!! $settings['google_map_iframe'] !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- footer section end -->

    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            @if (!empty($settings['copyright_info']))
                <p class="copyright_text">
                    {{ $settings['copyright_info'] }}
                </p>
            @endif
        </div>
    </div>
    <!-- copyright section end -->

    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    @stack('scripts')

</body>

</html>
