@extends('admin.layouts.master')

@section('content')

    @include('components.notification')

    @if(Auth::user()->is_super)
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card-box table-responsive">
                    <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.last_messages')) }}</b></h4>



                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-box table-responsive">
                    <div class="col-12 mb-4">
                        <a href="{{ route('companies.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.new_company')) }}</a>
                    </div>
                    <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_companies')) }}</b></h4>

                    <datatable route='companies' :collection="$companies" :fields="[
                'ID' => 'id',
                'datatable.headers.name' => 'name',
                'datatable.headers.number_restaurants' => 'restaurants_quantity',
                ]" />

                    <a href="{{ route('companies.index' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.view_all')) }}</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card-box table-responsive">
                    <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_pickups')) }}</b></h4>

                    <datatable route='pickups' :collection="$pickups" :fields="[
                'ID'    => 'id',
                'datatable.headers.name'  => 'name',
                'datatable.headers.price'  => 'price'
                ]"
                    />

                    <div class="col-12 mb-3">
                        <a href="{{ route('pickups.index' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.view_all')) }}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card-box table-responsive">
                    <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.sales_analytics')) }}</b></h4>



                </div>
            </div>
        </div>
    @elseif(Auth::user()->is_restaurateur)
        <div class="col-12 col-md-8">
            <div class="table-responsive">

                <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_orders')) }}</b></h4>

                <datatable route='orders-pickup' :collection="$ordersPickup" :fields="[
                'datatable.headers.offer'      => 'pickup:name',
                'datatable.headers.price' => 'pickup:price',
                ]"
                />
            </div>
        </div>
        <div class="col-12 col-md-4">

        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="card-box table-responsive">
                    <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_pickups')) }}</b></h4>

                    <datatable route='pickups' :collection="$pickups" :fields="[
                'ID'    => 'id',
                'datatable.headers.name'  => 'name',
                'datatable.headers.price'  => 'price'
                ]"
                    />

                    <div class="col-12 mb-3">
                        <a href="{{ route('pickups.index' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.view_all')) }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script type="text/javascript">
    </script>
@endpush
