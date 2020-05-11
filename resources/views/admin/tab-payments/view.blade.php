@extends('admin.layouts.master')

@section('content')


    @include('components.notification')

    <div class="row">

        <div class="col-12">
            <div class="card-box">
                {{--<a href="{{ route('restaurants.edit', $payment) }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>--}}
            </div>
        </div>

        <div class="col-12">
            <div class="card-box table-responsive">

                <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.history_payments')) }}</b></h4>

                {{--<datatable route='payments' :collection="$payments" :fields="[--}}
                {{--'datatable.headers.date_hour'      => 'created_at',--}}
                {{--'datatable.headers.total'      => '',--}}
                {{--]"--}}
                           {{--actions='view' />--}}
            </div>
        </div>
    </div>

@endsection
