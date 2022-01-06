@extends('layouts.admin')

@section('title', 'ဘာသာတွဲစာရင်းများ')

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
                <h3 class="card-title">မှတ်တမ်း {{ number_format($studies->count()) }} ခု တွေ့ရှိခဲ့သည်။</h3>

                <div class="d-flex justify-content-between float-right">

                    <form action="{{ route('admin.studies.index') }}" method="GET" class="mr-2">
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

                    <a class="btn btn btn-success" href="{{ route('admin.studies.create') }}">
                        <i class="fa fa-plus"></i> အသစ်ဖန်တီးပါ
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                @if ($studies->count() > 0)
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>အမှတ်စဥ်</th>
                                <th>ဘာသာတွဲ</th>
                                <th>ဖန်တီးရက်စွဲ</th>
                                <th>လုပ်ဆောင်ချက်များ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studies as $key => $study)
                                <tr>
                                    <td>{{ $studies->firstItem() + $key }}</td>
                                    <td>{{ $study->name }}</td>
                                    <td>{{ date('d/M/Y', strtotime($study->created_at)) }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.studies.edit', $study->id) }}">
                                            <i class="fas fa-edit"></i> တည်းဖြတ်
                                        </a>

                                        <a class="btn btn-sm btn-danger delete-btn"
                                            data-form-id="delete-form-{{ $study->id }}" href="#">
                                            <i class="fa fa-trash"></i> ဖယ်ရှား
                                        </a>

                                        <form id="delete-form-{{ $study->id }}"
                                            action="{{ route('admin.studies.destroy', $study->id) }}" method="POST"
                                            style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                {{ $studies->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
