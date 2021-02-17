@extends('admin.layouts.master')

@section('content')

@include('components.notification')
<div class="row m-b-10">
      <div class="col-12">
        @if(Route::currentRouteName() == 'products.filter.dishes')
          <a href="{{ route('products.create.dish', ['restaurant'=>$restaurant->first()->id] ) }}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.new_dish')) }}</a>
          <a href="{{ route('products.create.drink', ['restaurant'=>$restaurant->first()->id] ) }}" class="btn btn-success waves-effect w-md waves-light pull-right mr-3">{{ ucfirst(trans('button.new_drink')) }}</a>
        @else
          <a href="{{ route('products.create.dish' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.new_dish')) }}</a>
          <a href="{{ route('products.create.drink' )}}" class="btn btn-success waves-effect w-md waves-light pull-right mr-3">{{ ucfirst(trans('button.new_drink')) }}</a>
        @endif
      </div>
</div>

@if(Auth::user()->is_super)
<tag-form :action="route('products.filter.dishes')" method="get">
@include('admin.products.parts.form-filter')
</tag-form>
@endif
@if(!(Auth::user()->is_super && Route::currentRouteName() === 'products.index'))
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_dishes')) }}</b></h4>
            @if(Auth::user()->is_super && Route::currentRouteName() == 'products.filter.dishes')
                <datatable route='products' :collection="$products" :fields="[
                'ID' => 'id',
                'datatable.headers.name' => 'translate:name',
                'datatable.headers.type'  => 'color:type:color_type',
                'datatable.headers.brand' => 'company:name',
               'datatable.headers.restaurant' => 'restaurant:name',
                'datatable.headers.status' => 'status_product'
                ]"
                actions="edit, delete" />
            @elseif(Auth::user()->is_owner || Auth::user()->is_restaurant)
                <datatable route='products' :collection="$products" :fields="[
                'ID' => 'id',
                'datatable.headers.name' => 'translate:name',
                'datatable.headers.type'  => 'color:type:color_type',
                'datatable.headers.brand' => 'company:name',
                'datatable.headers.restaurant' => 'restaurant:name',
                'datatable.headers.status' => 'status_product'
                ]"
                actions="edit" />
            @else
            @endif

        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        @if(Auth::user()->is_super)
            $('#datatable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
                },
                "ordering": false
            });
        @else
            $('#datatable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
                },
                aaSorting: [[5, "desc"]]
            });
        @endif

    });

</script>
@endpush
