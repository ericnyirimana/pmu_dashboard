@extends('admin.layouts.master')

@section('content')


@include('components.notification')

<div class="card-box">
    <a href="{{ route('restaurants.edit', $ticket->pickup->restaurant) }}" class="btn btn-primary btn-bordered
    waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
</div>

<tag-form :action="route('ticket.update', $ticket)" method="put">
    @include('admin.tickets.parts.form')
</tag-form>

@endsection
