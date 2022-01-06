<!DOCTYPE html>
<html lang="my">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'ကျောင်းသားစီမံခန့်ခွဲမှုစနစ်') }} | ကျောင်းသားကဒ်ထုတ်ရန်</title>

  <style type="text/css">
    @font-face {
      font-family: 'Pyidaungsu';
      src: url({{storage_path('fonts/pyidaungsu.ttf')}}) format('truetype');
      font-weight: normal;
      font-style: normal;
    }

    body {
      font-family: "Pyidaungsu";
    }

    .rounded {
      border-radius: 25px;
    }

    .front {
      width: 300px;
      height: 400px;
    }

    .back {
      width: 300px;
      height: 400px;
    }

    .back > .top {
      background-color: green;
      height: 75px;
    }

    .front > .top {
      background-color: green;
      height: 75px;
    }

    .logo {
      width: 300px;
      height: 75px;
    }

    .passport-image {
      width: 100px;
      height: 110px;
      margin-top: 5px;
    }

    .digital-signature {
      width: 100px;
      height: 50px;
      margin-top: 7px;
    }

    .footer {
      background-color: green;
    }

    .top > h2 {
      line-height: 75px;
    }

    p {
      margin: 5px;
    }

    .back > .footer {
      margin-bottom: 10px;
    }
  </style>

  @php
    $settings = config('settings');
  @endphp
</head>

<body>

  <center>
    <div class="front rounded">
      <div class="top">
        <img class="logo" src="{{ asset($settings['logo']) }}">
      </div>

      <div class="body">
        <img src="{{ asset('storage') }}/{{ $cardInfo['image'] }}" class="passport-image">
        <p>အမည်: {{ $cardInfo['name'] }}</p>
        <p>နံပါတ်: <strong>{{ $cardInfo['id'] }}</strong></p>
        <p>ပေးအပ်သည့်ရက်စွဲ: <strong>{{ date('d/M/Y') }}</strong></p>

        @if(!empty($settings['digital_signature']))
          <img src="{{ asset($settings['digital_signature']) }}" class="digital-signature">
        @endif
      </div>

      <div class="footer"></div>
    </div>
  </center>

  <center style="margin-top: 10px;">
    <div class="back rounded">
      <div class="top">
        <h2>INSTRUCTIONS</h2>
      </div>

      <div class="body">
        <p>
          <strong>1. Bring your card everyday.</strong>
        </p>

        <p>
          <strong>2. Don't lose your card.</strong>
        </p>

        <div style="margin-bottom: 15px;">
          <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($cardInfo['id'])) !!} ">
        </div>
      </div>

      <div class="footer"></div>
    </div>
  </center>

</body>
</html>
