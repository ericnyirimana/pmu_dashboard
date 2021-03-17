@extends('admin.layouts.master')

@section('content')

@include('components.notification')

@include('components.fields-require-alert')

<div class="row">
    <div class="col-12">
      <div class="card-box">
      @if(Auth::user()->is_super && isset($_GET['restaurant']))
        <a href="{{ route('products.filter.dishes', ['restaurant'=>$restaurant->id, 'brand'=>$brand->id] ) }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
      @else
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
      @endif
      </div>
    </div>
</div>
<tag-form file :action="route('products.store')">
  @include('admin.products.parts.form')
</tag-form>
@endsection
