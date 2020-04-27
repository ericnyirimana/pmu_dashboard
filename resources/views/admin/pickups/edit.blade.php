@extends('admin.layouts.master')

@section('content')

@include('components.fields-require-alert')

<div class="row">
    <div class="col-12">
      <div class="card-box">
        <a href="{{ route('pickups.index') }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
      </div>
    </div>
</div>
<tag-form :action="route('pickups.update', $pickup)" method="put" >
  @include('admin.pickups.parts.form')
</tag-form>
@endsection
