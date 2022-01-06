@extends('layouts.admin')

@section('title', 'အကြံပြုချက်အမျိုးအစားများ')

@section('content')
<div class="app-main__inner">
    <ul class="list-group">
        <li class="list-group-item">{{ $recommendation_type->name }}</li>
    </ul>
</div>
@endsection
