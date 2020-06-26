@extends('admin.layouts.master')

@section('content')

    @include('components.notification')
    @if($pickup->orders->count() > 0 && $pickup->is_active_today)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        {{ __('messages.notification.pickup_not_editable') }}
    </div>
    @endif
    @include('components.fields-require-alert')
    <div id="error_response"></div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <a href="{{ route('pickups.index') }}"
                   class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
            </div>
        </div>
    </div>
    <tag-form :action="route('pickups.update', $pickup)" method="put">
        @include('admin.pickups.parts.form')
    </tag-form>
@endsection
