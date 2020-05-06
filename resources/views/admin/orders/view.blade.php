@extends('admin.layouts.master')

@section('content')


@include('components.notification')

    <div class="row m-b-10 card-box">
        <div class="col-12">
            <h2>{{ $order->id }}</h2>
        </div>
        <div class="col-md-3 col-lg-5">
            <p><label>{{ ucfirst(trans('labels.date')) }}:</label> {{ $order->date }}</p>
            <p><label>{{ ucfirst(trans('labels.order_type')) }}:</label> {{ $order->type_offer }}</p>
            <p><label>{{ ucfirst(trans('labels.offer')) }}:</label> {{ $order->name }}</p>
            {{--<p><label>{{ ucfirst(trans('labels.detail')) }}:</label> {{ $order }}</p>--}}
        </div>
        <div class="col-md-3 col-lg-5">
            <p><label>{{ ucfirst(trans('labels.customer_id')) }}:</label> {{ $order->user_id }}</p>
            <p><label>{{ ucfirst(trans('labels.status')) }}:</label> {{ $order->status }}</p>
            <p><label>{{ ucfirst(trans('labels.price')) }}:</label> {{ $order->offer_price }}</p>
        </div>

        <div class="form-group d-flex align-items-center justify-content-between col-12 mt-5">
            <button type="submit" class="btn btn-block w-lg btn-primary col-5">{{ ucfirst(trans('button.reject')) }}</button>
            <button type="submit" class="btn w-lg btn-success col-5">{{ ucfirst(trans('button.confirm')) }}</button>
        </div>
    </div>

@endsection
