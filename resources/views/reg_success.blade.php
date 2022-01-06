<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
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
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
</head>
<style>
    body {
        background-color: #e9ecef;
    }

    .display-3 {
        font-size: 2rem;
        line-height: none;
    }

    .blue-color {
        color: blue;
    }

    p {
        margin: 20px;
        font-weight: 300;
    }

    .fa {
        font-size: 3rem;
    }
</style>
<body>
    <div class="jumbotron text-center">
        <p class="lead">
            <a class="btn btn-lg" role="button"><i class="fa fa-check-circle blue-color"></i></a>
        </p>
        <h1 class="display-3">ကျေးဇူးတင်ပါသည်</h1>

        @if(!empty($regSuccessInfo['submit_option']) and $regSuccessInfo['submit_option'] == 'save')
            <p class="lead">သင်သည် အချက်အလက်များကို အောင်မြင်စွာ သိမ်းထားပြီးဖြစ်သည်။</p>
        @else
            <p class="lead">သင်သည် အမျိုးသားစီမံခန့်ခွဲမှုပညာဒီဂရီကောလိပ်အား အောင်မြင်စွာ လျှောက်ထားပြီးဖြစ်သည်။</p>
        @endif

        <hr>
        <p>လျှောက်လွှာအမှတ် : {{ $regSuccessInfo['application_code'] }}</p>
        <p>အကောင့်အမည် : {{ $regSuccessInfo['email'] }}</p>
        <p>လျှို့ဝှက်နံပါတ် : {{ $regSuccessInfo['password'] }}</p>
        <a href="{{ route('login') }}" class="btn btn-lg btn-success">အကောင့်ဝင်ရန်</a>
    </div>
</body>
</html>
