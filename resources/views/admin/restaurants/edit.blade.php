@extends('admin.layouts.master')

@section('content')

@include('components.fields-require-alert')

<div class="row">
    <div class="col-12">
      <div class="card-box">
        <a href="{{ route('companies.show', $restaurant->company) }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
      </div>
    </div>
</div>
<tag-form file :action="route('company.restaurants.update', [$restaurant->company, $restaurant])" method="put" >
  @include('admin.restaurants.parts.form')
</tag-form>
@endsection
