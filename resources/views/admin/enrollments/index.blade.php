@extends('layouts.admin')

@section('title', 'စာရင်းသွင်းခြင်း')

@section('content')

  <!-- /.row -->
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
          <h3 class="card-title">မှတ်တမ်း {{ number_format($enrollments->count()) }} ခု တွေ့ရှိခဲ့သည်။</h3>

          <div class="d-flex justify-content-between float-right">

            <form action="{{ route('admin.enrollments.index') }}" method="GET" class="mr-2">
              <div class="input-group">
                <input type="text" name="keyword" value="{{ \Request::get('keyword') }}" class="form-control" placeholder="search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>

            <a class="btn btn btn-success" href="{{ route('admin.enrollments.create') }}">
              <i class="fa fa-plus"></i> အသစ်ဖန်တီးပါ
            </a>
          </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          @if($enrollments->count() > 0)
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>အမှတ်စဥ်</th>
                  <th>ကျောင်းသား/သူ</th>
                  <th>မေဂျာဘာသာရပ်</th>
                  <th>ပညာသင်နှစ်</th>
                  <th>ခုံအမှတ်</th>
                  <th>စာရင်းသွင်းရက်</th>
                  <th>လုပ်ဆောင်ချက်များ</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($enrollments as $key => $enrollment)
                  <tr>
                    <td>{{ $enrollments->firstItem() + $key }}</td>
                    <td>
                      {{ $enrollment->user->profile->name_title_mm . $enrollment->user->profile->name_mm . '-' . $enrollment->user->studentId() }}
                    </td>
                    <td>{{ $enrollment->user->confirmedStudy->study->name }}</td>
                    <td>{{ $enrollment->academic_year_from }} - {{ $enrollment->academic_year_to }}</td>
                    <td>{{ !empty($enrollment->roll_number)? $enrollment->roll_number : '---' }}</td>
                    <td>{{ date('d/M/Y', strtotime($enrollment->created_at)) }}</td>
                    <td>

                      <a class="btn btn-sm btn-primary" href="{{ route('admin.enrollments.edit', $enrollment->id) }}">
                        <i class="fas fa-edit"></i> တည်းဖြတ်
                      </a>

                      <a class="btn btn-sm btn-danger delete-btn" data-form-id="delete-form-{{ $enrollment->id }}" href="#">
                        <i class="fa fa-trash"></i> ဖယ်ရှား
                      </a>

                      <form id="delete-form-{{ $enrollment->id }}" action="{{ route('admin.enrollments.destroy', $enrollment->id) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif

          {{ $enrollments->appends(request()->except('page'))->links() }}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->
@endsection
