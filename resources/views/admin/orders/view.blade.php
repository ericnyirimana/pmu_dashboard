@extends('admin.layouts.master')

@section('content')


@include('components.notification')
@if(Auth::user()->is_super)
<div id="error_response"></div>
<div class="card-box">
    <a href="{{ route('orders.index') }}" class="btn btn-primary btn-bordered
    waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
</div>


    @include('admin.orders.parts.form')

@endif
@endsection
