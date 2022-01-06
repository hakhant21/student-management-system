@extends('layouts.admin')

@section('title', 'ဓာတ်ပုံအမျိုးအစား')

@section('content')
<div class="app-main__inner">
    <ul class="list-group">
        <li class="list-group-item">{{ $image_type->name }}</li>
    </ul>
</div>
@endsection
