@extends('admin.layouts.master')

@section('content')

@include('admin.components.fields-require-alert')

<div class="row">
    <div class="col-12">
      <div class="card-box">
        <a href="{{ route('users.index') }}" class="btn btn-primary btn-bordered waves-effect w-lg">Back</a>
      </div>
    </div>
</div>
<tag-form file :action="route('users.update', [$user])" method="put" >
  @include('admin.users.parts.form')
</tag-form>
@endsection
