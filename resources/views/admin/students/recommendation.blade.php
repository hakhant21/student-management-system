<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        .address {
            width: 50%;
        }
        .address td {
            text-align: center;
        }
        table td, table th{
            border:1px solid black;
        }
        table tr, table td{
            padding: 5px;
        }

        @php
            $settings = config('settings');
        @endphp
    </style>
</head>
<body>
    <div class="container">
        <table align="center" width="50%">
            <tr>
                <th><img class="logo" src="{{ asset('storage') }}{{ asset($settings['logo']) }}" alt=""></th>
                <th>Ministry of Education Department.National Management Degree Collage, Yangon, Myanmar Department</th>
            </tr>
        </table>
        <table class="address" align="left">
            <tr>
                @if (!empty($settings['phone']))
                    <td>office - {{ $settings['phone'] }}</td>
                @endif
            </tr>
            <tr>
                @if (!empty($settings['phone']))
                    <td>admin and finance - {{ $settings['phone'] }}</td>
                @endif
            </tr>
        </table>
        <table class="address" align="right">
            <tr>
                @if (!empty($settings['address']))
                    <td>address - {{ $settings['address'] }}</td>
                @endif
            </tr>
            <tr>
                @if (!empty($settings['email']))
                    <td>email - {{ $settings['email'] }}</td>
                @endif
            </tr>
        </table>
    </div>
    <div>
        <hr>
        <h4 style="text-align: center">တက်ရောက်ကြောင်းထောက်ခံ</h4>
        <p style="text-indent: 40px; text-align: justify" >
            {{ $recommendInfo['name_title'] }}{{ $recommendInfo['name'] }}
            နိုင်ငံသားစီစစ်ရေးကတ်ပြားအမှတ် {{ $recommendInfo['nrc'] }}
            အဖအမည် - {{ $recommendInfo['father_name_title'] }}{{ $recommendInfo['father_name'] }} ၏သားသည်
            အမျိုးသားစီမံခန့်ခွဲမှုပညာဒီဂရီကောလိပ် {{ $recommendInfo['academic_year'] }} ပညာသင်နှစ် {{ $recommendInfo['study'] }} သင်တန်းကို
            ခုံအမှတ် {{ $recommendInfo['roll_number'] }} ဖြင့် တက်ရောက်ကြောင်း ထောက်ခံပါသည်။
        </p>
        <P>
            ကျောင်းဝင်အမှတ် {{ $recommendInfo['id'] }} အရ ၎င်း၏မွေးသက္ကရာဇ်မှာ {{ $recommendInfo['birthday'] }} ဖြစ်ပါသည်။
        </P>
    </div>
</body>
</html>
