@extends('admin.layouts.master')

@section('content')


@include('components.notification')

<tag-form :action="route('orders.update', $order)" method="put" >
    @include('admin.tab-orders.parts.form')
</tag-form>

@endsection
