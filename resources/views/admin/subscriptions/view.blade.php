@extends('admin.layouts.master')

@section('content')

    @include('components.notification')

    <div class="card-box">
        <a href="{{ route('subscriptions.index') }}" class="btn btn-primary
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
                <p><label>{{ ucfirst(trans('labels.price')) }}:</label> {{number_format($pickupSubscription->price_with_discount,
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


    <div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.subscription_orders')) }}</b></h4>
            <datatable class='subscription-orders' route='subscriptions' :collection="$orderPickupDetail" :checkRow="true" :fields="[
                        'Ticket Id'      => 'id',
                        'datatable.headers.name' => 'first_name',
                        'datatable.headers.last_name' => 'last_name',
                        'datatable.headers.date'  => 'date',
                        'datatable.headers.status'  => 'expiry_status',
                        'datatable.headers.validity'  => 'validity_date_interval',
                        'datatable.headers.subscriptiion_qty_offered' => 'quantity_subscription',
                        'datatable.headers.subscriptiion_qty_remaining' => 'quantity_remain',
                        ]"      
                        actions="detail" />
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {
                $('.subscription-orders').dataTable({
                    "language": {
                        "url": "cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
                    }});

			});

    </script>
@endpush