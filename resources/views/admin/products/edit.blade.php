@extends('admin.layouts.master')

@section('content')

@include('components.fields-require-alert')

<div class="row">
    <div class="col-12">
      <div class="card-box">
      @php
        $explode_prev_route = explode('?', url()->previous());
        $prev_route = $explode_prev_route[0];
      @endphp
      @if(Auth::user()->is_super && ($prev_route === route('products.filter.dishes')))
        <a href="{{ route('products.filter.dishes', ['restaurant'=>$product->restaurant->id, 'brand'=>$product->company->id] ) }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
      @else
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-bordered waves-effect w-lg">{{ ucfirst(trans('button.back')) }}</a>
      @endif
      </div>
    </div>
</div>
<tag-form file :action="route('products.update', $product)" method="put" >
  @include('admin.products.parts.form')
</tag-form>
@endsection
