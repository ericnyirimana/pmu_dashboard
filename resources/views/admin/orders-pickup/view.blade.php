@extends('admin.layouts.master')

@section('content')


@include('components.notification')

<div class="card-box">
    <a href="{{ route('restaurants.edit', $ordersPickup->pickup->restaurant) }}" class="btn btn-primary btn-bordered
    waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
</div>

<tag-form :action="route('orders-pickup.update', $ordersPickup)" method="put">
    @include('admin.orders-pickup.parts.form')
</tag-form>

@endsection
