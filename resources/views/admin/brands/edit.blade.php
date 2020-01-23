@extends('admin.layouts.master')

@section('content')

@include('admin.components.fields-require-alert')

<div class="row">
    <div class="col-12">
      <div class="card-box">
        <a href="{{ route('brands.index') }}" class="btn btn-primary btn-bordered waves-effect w-lg">Back</a>
      </div>
    </div>
</div>

<tag-form file :action="route('brands.update', $brand)" method="put" >
  @include('admin.brands.parts.form')
</tag-form>

@endsection
