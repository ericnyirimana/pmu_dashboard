@extends('admin.layouts.master')

@section('content')

    @include('components.notification')

    <div class="card-box">
        <a href="{{ route('restaurants.edit', $pickupSubscription->restaurant) }}" class="btn btn-primary
        btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
    </div>

    <div class="card-box">
        <div class="row m-b-10">
            <div class="col-12">
                <h2>{{ ucfirst(trans('labels.id_subscription')) }}: #{{ $pickupSubscription->id }}</h2>
            </div>

            <div class="col-12">
            <br>
            </div>

            <div class="col-6 col-md-3 col-lg-5">
                <p><label>{{ ucfirst(trans('labels.validity_range')) }}:</label> {{
                $pickupSubscription->pickup->date
                }}</p>
            </div>
            <div class="col-6 col-md-3 col-lg-5">
                <p><label>{{ ucfirst(trans('labels.validate_months')) }}:</label> {{
                $pickupSubscription->validate_months . ' ' . __('labels.working_months')}}</p>
            </div>

            <div class="col-6 col-md-3 col-lg-5">
                <p><label>{{ ucfirst(trans('labels.offer')) }}:</label> {{ $pickupSubscription->pickup->name
                }}</p>
            </div>
            <div class="col-6 col-md-3 col-lg-5">
                <p><label>{{ ucfirst(trans('labels.price')) }}:</label> {{number_format($pickupSubscription->price,
                2, ',', '.').'€' }}</p>
            </div>

            <!--
            <div class="col-12">
                <p><label>{{ ucfirst(trans('labels.mealtype')) }}:</label> - </p>
            </div>
            -->

            <div class="col-6 col-md-3 col-lg-5">
                <p><label>{{ ucfirst(trans('labels.subscriptions_number_available')) }}:</label> {{
                $pickupSubscription->quantity_offer
                }}</p>
            </div>

            <div class="col-6 col-md-3 col-lg-5">
                <p><label>{{ ucfirst(trans('labels.number_dishes_x_subscriptions')) }}:</label> {{
                $pickupSubscription->quantity_per_subscription
                }}</p>
            </div>
        </div>
        <div class="row m-b-10">
            <div class="col-12 ">
                <h4>{{ ucfirst(trans('labels.menu')) }}</h4>
            </div>

            @foreach($menu as $section => $products)
                <div class="col-2">
                    <p><label>{{ $section }}:</label></p>
                </div>
                <div class="col-10">
                    @foreach($products as $product)
                        <span>{{ $product->name }}</span><br>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>

@endsection
