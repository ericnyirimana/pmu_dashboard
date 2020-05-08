@extends('admin.layouts.master')

@section('content')


    @include('components.notification')

    <div class="card-box">
        <a href="{{ route('restaurants.edit', $subscriptions) }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
    </div>

    <tag-form :action="route('subscriptions.update', $subscriptions)" method="put">
        @include('admin.subscriptions.parts.form')
    </tag-form>

@endsection
