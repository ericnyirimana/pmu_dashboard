@extends('admin.layouts.master')

@section('content')

@include('components.fields-require-alert')

<div class="row">
    <div class="col-12">
      <div class="card-box">
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
      </div>
    </div>
</div>
<tag-form file :action="route('products.update', $product)" method="put" >
  @include('admin.products.parts.form')
</tag-form>
@endsection
