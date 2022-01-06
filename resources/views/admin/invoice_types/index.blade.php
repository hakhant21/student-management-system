@extends('layouts.admin')

@section('title', 'ငွေတောင်းခံလွှာအမျိုးအစားစာရင်းများ')

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
                <h3 class="card-title">မှတ်တမ်း {{ number_format($invoice_types->count()) }} ခုတွေ့ရှိခဲ့သည်။</h3>

                <div class="d-flex justify-content-between float-right">
                    
                    <form action="{{ route('admin.invoice_types.index') }}" method="GET" class="mr-2">
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

                    <a class="btn btn btn-success" href="{{ route('admin.invoice_types.create') }}">
                        <i class="fa fa-plus"></i> အသစ်ဖန်တီးပါ
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                @if ($invoice_types->count() > 0)
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>အမှတ်စဥ်</th>
                                <th>ငွေတောင်းခံလွှာအမျိုးအစား</th>
                                <th>ဖန်တီးရက်စွဲ</th>
                                <th>လုပ်ဆောင်ချက်များ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice_types as $key => $invoice_type)
                                <tr>
                                    <td>{{ $invoice_types->firstItem() + $key }}</td>
                                    <td>{{ $invoice_type->name }}</td>
                                    <td>{{ date('d/M/Y', strtotime($invoice_type->created_at)) }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.invoice_types.edit', $invoice_type->id) }}">
                                            <i class="fas fa-edit"></i> တည်းဖြတ်
                                        </a>

                                        <a class="btn btn-sm btn-danger delete-btn"
                                            data-form-id="delete-form-{{ $invoice_type->id }}" href="#">
                                            <i class="fa fa-trash"></i> ဖယ်ရှား
                                        </a>

                                        <form id="delete-form-{{ $invoice_type->id }}"
                                            action="{{ route('admin.invoice_types.destroy', $invoice_type->id) }}"
                                            method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                {{ $invoice_types->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
