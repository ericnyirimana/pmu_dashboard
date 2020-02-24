@extends('admin.layouts.master')

@section('content')

@include('components.fields-require-alert')

<div class="row">
    <div class="col-12">
      <div class="card-box">
        <a href="{{ route('menu.index') }}" class="btn btn-primary btn-bordered waves-effect w-lg">Back</a>
      </div>
    </div>
</div>
<tag-form file :action="route('menu.store')">
  @include('admin.menu.parts.form')
</tag-form>
@endsection
