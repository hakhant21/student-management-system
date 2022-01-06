@extends('layouts.admin')

@section('title', 'ငွေစာရင်းတောင်းခံခြင်းစာရင်း')

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
                <h3 class="card-title">မှတ်တမ်း {{ number_format($invoices->count()) }} ခု တွေ့ရှိခဲ့သည်။</h3>

                <div class="d-flex justify-content-between float-right">

                    <form action="{{ route('admin.invoices.index') }}" method="GET" class="mr-2">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ \Request::get('keyword') }}"
                                class="form-control" placeholder="search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <a class="btn btn btn-success" href="{{ route('admin.invoices.create') }}">
                        <i class="fa fa-plus"></i> အသစ်ဖန်တီးပါ
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                @if ($invoices->count() > 0)
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>အမှတ်စဥ်</th>
                                <th>ကျောင်းသား/သူ</th>
                                <th>မေဂျာဘာသာရပ်</th>
                                <th>ခုံအမှတ်</th>
                                <th>ငွေစာရင်းထုတ်ရက်</th>
                                <th>အခြေအနေ</th>
                                <th>လုပ်ဆောင်ချက်များ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $key => $invoice)
                                <tr>
                                    <td>{{ $invoices->firstItem() + $key }}</td>
                                    <td>
                                        {{ $invoice->user->profile->name_mm . ' - ' . $invoice->user->studentId() }}
                                    </td>
                                    <td>
                                        {{-- {{ $invoice->user->confirmedStudy->study->name }} --}}
                                    </td>
                                    <td>{{ !empty($invoice->user->activeEnrollment()) ? $invoice->user->activeEnrollment()->roll_number : '---' }}</td>
                                    <td>{{ date('d/M/Y', strtotime($invoice->invoiced_at)) }}</td>
                                    <td>
                                        @if ($invoice->is_paid == 1)
                                            <span class="badge badge-success"> ငွေပေးချေပြီး </span>
                                        @else
                                            <span class="badge badge-warning"> ငွေမပေးချေရသေး </span>
                                        @endif
                                    </td>
                                    <form id="delete-form-{{ $invoice->id }}"
                                        action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST"
                                        style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.invoices.edit', $invoice->id) }}">
                                            <i class="fas fa-edit"></i> တည်းဖြတ်
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                {{ $invoices->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
