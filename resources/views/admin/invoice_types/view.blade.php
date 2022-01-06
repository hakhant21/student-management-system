@extends('layouts.admin')

@section('title', 'ငွေတောင်းခံလွှာအမျိုးအစားများ')

@section('content')
<div class="app-main__inner">
    <ul class="list-group">
        <li class="list-group-item">{{ $invoice_type->name }}</li>
    </ul>
</div>
@endsection
