<div class="row m-b-10">
    <div class="col-12">
        <h2>{{ ucfirst(trans('labels.id_order')) }}: {{ $pickupSubscription->pickup_subscriptions->id }}</h2>
    </div>
    <div class="col-md-3 col-lg-5">
        <p><label>{{ ucfirst(trans('labels.date_hour')) }}:</label> {{ $pickupSubscription->pickup->date->format('d/m/Y - H:m') }}</p>
        <p><label>{{ ucfirst(trans('labels.order_type')) }}:</label> {{ $pickupSubscription->pickup_subscriptions->type_offer }}</p>
        <p><label>{{ ucfirst(trans('labels.offer')) }}:</label> {{ $pickupSubscription->pickup->name }}</p>
    </div>
    <div class="col-md-3 col-lg-5">
        <p><label>{{ ucfirst(trans('labels.customer_id')) }}:</label> {{ $pickupSubscription->pickup_subscriptions->validate_days }}</p>
        <p><label>{{ ucfirst(trans('labels.price')) }}:</label> {{ $pickupSubscription->pickup_subscriptions->price }}</p>
    </div>

</div>
