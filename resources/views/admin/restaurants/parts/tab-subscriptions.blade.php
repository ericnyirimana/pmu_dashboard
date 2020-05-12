<div class="row">
    <div class="col-12">
        <div class="table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.active_subscriptions')) }}</b></h4>


            <div class="d-flex justify-content-between align-items-center">
                @foreach($pickupSubscriptions as $pickupSubscription)
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">#{{ $pickupSubscription->id }}</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title">{{ $pickupSubscription->pickup->name }}</h3>
                                <h3 class="card-title">{{ $pickupSubscription->price }} €</h3>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>{{ ucfirst(trans('labels.validate_subscription')) }}</strong>:<br>
                                {{ $pickupSubscription->pickup->date }}</li>
                            <li class="list-group-item"><strong>{{ ($pickupSubscription->pickup->quantity_offer *
                            $pickupSubscription->validate_days) }}</strong> {{ ucfirst(trans('labels.sale_subscriptions')) }}</li>
                            <li class="list-group-item"><strong>{{
                            $pickupSubscription->pickup->orders->sum('quantity') }}</strong> {{ ucfirst(trans
                            ('labels.purchase_subscriptions')) }}</li>
                            <li class="list-group-item"><strong>{{ $pickupSubscription->offers_purchased }}</strong> {{
                            ucfirst(trans('labels.orders_collected')
                            ) }}</li>
                            <li class="list-group-item"><strong>{{ ($pickupSubscription->pickup->quantity_offer *
                            $pickupSubscription->pickup->orders->sum('quantity') - $pickupSubscription->offers_purchased) }}</strong> {{ ucfirst(trans('labels.orders_to_be_collected')) }}</li>
                        </ul>
                        <div class="card-body">
                            <a href="{{ route('subscription.show', $pickupSubscription) }}" class="card-link btn btn-primary float-right">{{ ucfirst(trans('button.subscription_detail')) }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {



			});

    </script>
@endpush
