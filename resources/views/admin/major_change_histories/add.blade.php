@extends('layouts.admin')

@section('title', 'မေဂျာပြောင်းလဲမှု အသစ်ဖန်တီး')

@section('content')
<div class="container">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <form action="{{ route('admin.major_change_histories.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputStudent">ကျောင်းသား/သူ</label>
                        <select name="user_id" class="form-control" required>
                            <option value="">---</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->user_id }}">{{ $student->name_mm }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('user_id'))
                            <p class="text-danger"></p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="inputStudent">ဘာသာရပ်</label>
                        <select name="new_study_id" class="form-control" required>
                            <option value="">---</option>
                            @foreach ($studies as $study)
                                <option value="{{ $study->id }}">{{ $study->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('new_study_id'))
                            <p class="text-danger">{{ $errors->first() }}</p>
                        @endif
                    </div>

                    <div class="form-row mt-4">
                        <div class="col-md-2">
                            <input type="submit" value="OK" class="btn btn-success form-control">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
