@extends('layouts.admin')

@section('title', 'ကျောင်းသားစီမံခန့်ခွဲမှုစနစ်')

@section('content')
<div class="app-main__inner">
    <ul class="list-group">
        <li class="list-group-item">{{ $subject->name }}</li>
    </ul>
</div>
@endsection
