@extends('layouts.admin')

@section('title', 'ကျောင်းသား/သူစာရင်းများ')

@section('content')
<div class="row">
    <div class="col-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">မှတ်တမ်း {{ number_format($users->count()) }} ခု တွေ့ရှိခဲ့သည်။</h3>

                <div class="d-flex justify-content-between float-right">
                    <form action="{{ route('admin.users.index') }}" method="GET" class="mr-2">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ \Request::get('keyword') }}"
                                class="form-control" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="card-body table-responsive p-0">
                @if ($users->count() > 0)
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>အမှတ်စဥ်</th>
                                <th>ကျောင်းသား/သူ</th>
                                <th>နိုင်ငံသားစိစစ်ရေးကတ်ပြားအမှတ်</th>
                                <th>ဖခင်အမည်</th>
                                <th>အီးမေးလ်လိပ်စာ</th>
                                <th>လုပ်ဆောင်ချက်များ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $key }}</td>
                                    <td>{{ $user->name . '-' . $user->studentId() }}</td>
                                    <td>{{ implode('/', json_decode($user->profile->nrc_mm, true)) }}</td>
                                    <td>
                                        {{ $user->profile->father_name_title_mm . $user->profile->father_name_mm }}
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->image) and !empty($user->profile->name_mm) and !empty($user->studentId()))
                                            <a class="btn btn-sm btn-success" href="{{ route('admin.users.card.print', $user->id) }}" target="_blank">
                                                <i class="fas fa-print"></i> ကျောင်းသားကဒ်ထုတ်ရန်
                                            </a>

                                            <div class="dropdown d-inline">
                                                <button id="recommendation-print-btn" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    ထောက်ခံစာထုတ်ရန်
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('admin.users.recommendation.printExcel', $user->id) }}">Attending</a>
                                                </div>
                                            </div>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-success student-card-print">
                                                <i class="fas fa-print"></i> ကျောင်းသားကဒ်ထုတ်ရန်
                                            </button>

                                            <button type="submit" class="btn btn-sm btn-success student-recommend-print">
                                                <i class="fas fa-print"></i> ထောက်ခံစာထုတ်ရန်
                                            </button>
                                        @endif

                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.users.show', $user->id) }}">
                                            <i class="fas fa-edit"></i> အသေးစိတ်ကြည့်ရန်
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                {{ $users->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('.student-card-print').click(function () {
            alert('ကျောင်းသားကတ်ပုံနှိပ်ခြင်းတွင် အမည်၊ ရုပ်ပုံနှင့် ကျောင်းသား ID လိုအပ်သည်။');
        });
    });

    $(function () {
        $('.student-recommend-print').click(function () {
            alert('ကျောင်းသားထောက်ခံစာထုတ်ခြင်းတွင် အမည်၊ ရုပ်ပုံနှင့် ကျောင်းသား ID လိုအပ်သည်။');
        });
    });
</script>
@endpush
