@extends('layouts.admin')

@section('title', 'လျှောက်လွှာများ')

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

        <!-- Search -->
        @include('admin.entrance_applications.search')

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">မှတ်တမ်း {{ number_format($applications->count()) }} ခုတွေ့ရှိခဲ့သည်။</h3>
            </div>

            <div class="card-body table-responsive p-0">
                @if ($applications->count() > 0)
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>အမှတ်စဥ်</th>
                                <th>ဝင်ခွင့်လျှောက်လွှာနံပါတ်</th>
                                <th>လျှောက်ထားသူအမည်</th>
                                <th>စုစုပေါင်းအမှတ်</th>
                                <th>ဆက်သွယ်ရန်ဖုန်း</th>
                                <th>လျှောက်ထားသည့်ရက်စွဲ</th>
                                <th>အခြေအနေ</th>
                                <th>လုပ်ဆောင်ချက်များ</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($applications as $key => $application)
                                <tr>
                                    <td>{{ $applications->firstItem() + $key }}</td>
                                    <td>{{ $application->code }}</td>
                                    <td>{{ $application->user->name }}</td>
                                    <td>{{ $application->matriculationDetail->totalMarks() }}</td>
                                    <td>{{ $application->profile->contact_phone }}</td>
                                    <td>{{ date('d/M/Y', strtotime($application->activeSubmission()->created_at)) }}
                                    </td>
                                    <td>
                                        @if ($application->activeSubmission()->status == 1)
                                            <span class="badge badge-success"> အတည်ပြုပြီး </span>
                                        @elseif ($application->activeSubmission()->status == 2)
                                            <span class="badge badge-danger"> ငြင်းပယ်ပြီး </span>
                                        @else
                                            <span class="badge badge-secondary"> လျှောက်ထားဆဲ </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.entrance_applications.show', $application->id) }}">
                                            <i class="fas fa-edit"></i> အသေးစိတ်ကြည့်ရန်
                                        </a>

                                        <form id="delete-form-{{ $application->id }}"
                                            action="{{ route('admin.entrance_applications.destroy', $application->id) }}"
                                            method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $applications->appends(request()->except('page'))->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script>
    $(function() {
        $('.datepicker').datepicker({
            clearBtn: true,
            format: "dd/mm/yyyy"
        });
    });
</script>
@endpush
