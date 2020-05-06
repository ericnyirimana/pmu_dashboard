@extends('admin.layouts.master')

@section('content')


@include('components.notification')

<tag-form :action="route('orders.update', $order)" method="put" >
    @include('admin.orders.parts.form')
</tag-form>

@endsection
