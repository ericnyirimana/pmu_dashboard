@extends('admin.layouts.master')

@section('content')

@if (session('notification') )
  @component('components.notification')
      @slot('type')
          {{ session('type-notification') }}
      @endslot
      {{ session('notification') }}
  @endcomponent
@endif
@if(Auth::user()->is_super || Auth::user()->is_owner)
<tag-form :action="route('filtering-pickup-subscription.data')" method="get">
@include('admin.subscriptions.parts.form-filter')
</tag-form>
@endif
@if(Route::currentRouteName() == 'filtering-pickup-subscription.data' || Auth::user()->is_restaurant) 
<div class="row">
    <div class="col-12">

        <h4 class="m-t-0 header-title pb-4"><b>{{ ucfirst(trans('datatable.active_subscriptions')) }}</b></h4>

        @if(isset($pickupSubscriptions))           
            <div class="container">
                <div class="row">
                @foreach($pickupSubscriptions as $pickupSubscription)  
                        <div class="col-12 col-md-6 pb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">#{{ $pickupSubscription->id }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="card-title">{{ $pickupSubscription->pickup->name }}</h3>
                                        <h3 class="card-title">{{ $pickupSubscription->price_with_discount }} €</h3>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>{{ ucfirst(trans('labels.validate_subscription')) }}</strong>:<br>
                                        {{ $pickupSubscription->pickup->date }}</li>
                                    <li class="list-group-item"><strong>{{ ucfirst(trans('labels.subscription_validate_months')) }}</strong>:
                                        {{ $pickupSubscription->validate_months }} {{ ucfirst(trans('labels.months')) }}</li>
                                    <li class="list-group-item"><strong>{{ $pickupSubscription->quantity_offer }}</strong> {{ ucfirst(trans('labels.sale_subscriptions')) }}</li>
                                    <li class="list-group-item"><strong>{{
                                    $pickupSubscription->pickup->orders->sum('quantity') }}</strong> {{ ucfirst(trans
                                    ('labels.purchase_subscriptions')) }}</li>
                                </ul>
                                <div class="card-body">
                                    <a href="{{ route('subscriptions.show', $pickupSubscription->id) }}" class="card-link btn btn-primary float-right">{{ ucfirst(trans('button.subscription_detail')) }}</a>
                                </div>
                            </div>
                        </div>
                @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endif
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $('#datatable').DataTable({

            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
            },
            "order": [[ 0, "desc" ]]
        });

    });

</script>
@endpush
