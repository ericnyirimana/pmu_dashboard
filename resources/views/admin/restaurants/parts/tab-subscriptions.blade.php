<div class="row">
    <div class="col-12">
        <div class="table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.active_subscriptions')) }}</b></h4>


            <div class="d-flex justify-content-between align-items-center">
                @foreach($subscriptions as $subscription)
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">#{{ $subscription->id }}</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title">{{ $subscription->name }}</h3>
                                <h3 class="card-title">{{ $subscription->price }} €</h3>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>{{ ucfirst(trans('labels.validate_subscription')) }}</strong>:<br>
                                {{ $subscription->date }}</li>
                            <li class="list-group-item"><strong>{{ $subscription->quantity_remain }}</strong> {{ ucfirst(trans('labels.sale_subscriptions')) }}</li>
                            <li class="list-group-item"><strong>{{ $subscription->quantity_per_subscription }}</strong> {{ ucfirst(trans('labels.purchase_subscriptions')) }}</li>
                            <li class="list-group-item"><strong></strong>{{ ucfirst(trans('labels.orders_collected')) }}</li>
                            <li class="list-group-item"><strong></strong>{{ ucfirst(trans('labels.orders_to_be_collected')) }}</li>
                        </ul>
                        <div class="card-body">
                            <a href=" # {{--{{ route('admin.subscriptions.view') }}--}}" class="card-link btn btn-primary float-right">{{ ucfirst(trans('button.subscription_detail')) }}</a>
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
