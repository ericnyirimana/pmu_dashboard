@extends('admin.layouts.master')

@section('content')

    @include('components.notification')

    <div class="card-box">
        {{--<a href="{{ route('restaurants.edit', $pickupSubscription) }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>--}}
    </div>

    <div class="card-box">
        <div class="row m-b-10">
            <div class="col-12">
                <h2>{{ ucfirst(trans('labels.id_subscription')) }}: {{ $pickupSubscription->id }}</h2>
            </div>
            <div class="col-md-3 col-lg-5">
                <p><label>{{ ucfirst(trans('labels.date_hour')) }}:</label> {{ $pickupSubscription->date }}</p>
                <p><label>{{ ucfirst(trans('labels.offer_type')) }}:</label> {{ $pickupSubscription->type_offer }}</p>
                <p><label>{{ ucfirst(trans('labels.offer')) }}:</label> {{ $pickupSubscription->name }}</p>
            </div>
            <div class="col-md-3 col-lg-5">
                <p><label>{{ ucfirst(trans('labels.validate_days')) }}:</label> {{ $pickupSubscription->validate_days }}</p>
                <p><label>{{ ucfirst(trans('labels.price')) }}:</label> {{ $pickupSubscription->price }}</p>
            </div>
        </div>
    </div>

@endsection
