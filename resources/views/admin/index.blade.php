@extends('admin.layouts.master')

@section('content')

    @include('components.notification')

    @if(Auth::user()->is_super)
        <div class="row mb-3">
            <div class="col-12 col-md-8">
                <div class="card-box table-responsive h-100">
                    <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_pickups')) }}</b></h4>
                    @if($pickups->count() > 0)
                    <datatable route='pickups' :collection="$pickups" :fields="[
                        'datatable.headers.name'  => 'name',
                        'datatable.headers.price'  => 'price',
                        'datatable.headers.quantity'  => 'quantity_offer'
                        ]"
                    />
                    @endif
                    <a href="{{ route('pickups.index' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.view_all')) }}</a>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-box table-responsive h-100">
                    <div class="mb-4">
                        <a href="{{ route('companies.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.new_company')) }}</a>
                    </div>
                    <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_companies')) }}</b></h4>
                    @if($companies->count() >0)
                    <datatable route='companies' :collection="$companies" :fields="[
                        'ID' => 'id',
                        'datatable.headers.name' => 'name',
                        'datatable.headers.number_restaurants' => 'restaurants_quantity',
                        ]"
                    />
                    @endif
                    <a href="{{ route('companies.index' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.view_all')) }}</a>
                </div>
            </div>
        </div>
        <div class="row">
            {{--<div class="col-12 col-md-6">--}}
                {{----}}
            {{--</div>--}}

            {{--<div class="col-12 col-md-6">--}}
                {{--<div class="card-box table-responsive">--}}
                    {{--<h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.sales_analytics')) }}</b></h4>--}}



                {{--</div>--}}
            {{--</div>--}}
        </div>
    @elseif(Auth::user()->is_restaurant)
        <div class="row mb-3">
            <div class="col-12 col-md-8">
                <div class=" card-box table-responsive h-100">

                    <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_orders')) }}</b></h4>
                    @if($ordersPickup->count() > 0)
                    <datatable route='orders-pickup' :collection="$ordersPickup" :fields="[
                    'datatable.headers.date'      => 'order:date_format',
                    'datatable.headers.hour'      => 'order:hour_format',
                    'datatable.headers.offer'      => 'pickup:name',
                    'datatable.headers.price' => 'pickup:price',
                    ]"
                  actions='view'
                    />
                    @endif

                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class=" card-box table-responsive h-100">

                    <h4 class="m-t-0 header-title"><b>Sto arrivando!</b></h4>
                    @if($ordersPickup->count() > 0)
                    <datatable route='orders-pickup' :collection="$ordersPickup" :fields="[
                    'datatable.headers.hour'      => 'order:hour_format',
                    'datatable.headers.offer'      => 'pickup:name',
                    'datatable.headers.price' => 'pickup:price',
                    ]"
                    />
                    @endif
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-12 col-md-8">
                <div class="card-box table-responsive">
                    <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_pickups')) }}</b></h4>
                    @if($pickups->count() > 0)
                    <datatable route='pickups' :collection="$pickups" :fields="[
                'datatable.headers.name'  => 'name',
                'datatable.headers.price'  => 'price',
                'datatable.headers.quantity'  => 'quantity_offer'
                ]"
                    />
                    @endif
                    <div class="col-12 mb-3">
                        <a href="{{ route('pickups.index' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.view_all')) }}</a>
                    </div>
                </div>
            </div>

            {{--<div class="col-12 col-md-4">--}}
                {{--<div class="card-box table-responsive">--}}
                    {{--<h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.sales_analytics')) }}</b></h4>--}}



                {{--</div>--}}
            {{--</div>--}}
        </div>
    @endif

@endsection

@push('scripts')
    <script type="text/javascript">
    </script>
@endpush
