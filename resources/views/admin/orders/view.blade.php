@extends('admin.layouts.master')

@section('content')


@include('components.notification')
<div id="error_response"></div>
<div class="card-box">
    <a href="{{ route('orders.index') }}" class="btn btn-primary btn-bordered
    waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
</div>


    @include('admin.orders.parts.form')

@endsection
