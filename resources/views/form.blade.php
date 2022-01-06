<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .head .container {
            justify-content: center;
        }

        .img {
            display: block;
        }
        hr {
            margin-top: 5%;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="head">
        <div class="container">
            <table>
                <tr>
                    <td><img src="{{ asset('images/education-logo.jpg') }}" alt=""></td>
                    <td><p>Unio of Education Department, National Management Degreee College, Yangon, Myanmar</p></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="contact">
        <div class="container">
            <table style="float: left">
                <tr>
                    @if (!empty($settings['phone']))
                        <td>Office</td>
                        <td>&nbsp; {{ $settings['phone'] }}</td>
                    @endif
                </tr>
                <tr>
                    @if (!empty($settings['phone']))
                        <td>Admin & Finance</td>
                        <td>&nbsp; {{ $settings['phone'] }}</td>
                    @endif
                </tr>
            </table>
            <table style="float: right">
                <tr>
                    @if (!empty($settings['address']))
                        <td>Address</td>
                        <td>&nbsp; {{ $settings['address'] }}</td>
                    @endif
                </tr>
                <tr>
                    @if (!empty($settings['email']))
                        <td>email</td>
                        <td>&nbsp; {{ $settings['email'] }}</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="content">
        <div class="container">
            <h4 style="text-align: center">တက်ရောက်ကြောင်းထောက်ခံ</h4>
            <p style="text-indent: 40px; text-align: justify">မောင်ရဲထက်အောင် နိုင်ငံသားစီစစ်ရေးကတ်ပြားအမှတ် 14/PaThaNa(N)235973 အဖအမည် - ဦးမျိုးညွှန့်၏ သားသည် အမျိုးသားစီမံခန့်ခွဲမှုပညာဒီဂရီကောလိပ် ၂၀၁၉-၂၀၂၀ ပညာသင်နှစ် ပထမနှစ်
                Journalism(JNL) သင်တန်းကို ခုံအမှတ် IV-JNL-57 ဖြင့် တက်ရောက်ကြောင်း ထောက်ခံပါသည်။
            </p>
            <p>
                ကျောင်းဝင်အမှတ် NMC-00009820 အရ ၎င်း၏မွေးသက္ကရာဇ်မှာ 22/01/1997 ဖြစ်ပါသည်။
            </p>
        </div>
    </div>
</body>
</html>
