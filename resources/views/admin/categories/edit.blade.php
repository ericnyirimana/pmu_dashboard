@extends('admin.layouts.master')

@section('content')

@include('admin.components.fields-require-alert')

<div class="row">
    <div class="col-12">
      <div class="card-box">
        <a href="{{ route('categories.index') }}" class="btn btn-primary btn-bordered waves-effect w-lg">Back</a>
      </div>
    </div>
</div>

<tag-form file :action="route('categories.update', $category)" method="put" >
  @include('admin.categories.parts.form')
</tag-form>
@endsection
