@extends('admin.layouts.master')

@section('content')

@include('components.fields-require-alert')
<div class="row">
    <div class="col-12">
    <div id="error_response"></div>
      <div class="card-box">
        <a href="{{ route('pickups.index') }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
      </div>
    </div>
</div>
<tag-form file :action="route('loyalty-card.store')">
  @include('admin.loyalty-card.parts.form')
</tag-form>
@endsection
