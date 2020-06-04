@extends('admin.layouts.master')

@section('content')

@include('components.notification')
<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('products.create.dish' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.new_dish')) }}</a>
          <a href="{{ route('products.create.drink' )}}" class="btn btn-success waves-effect w-md waves-light pull-right mr-3">{{ ucfirst(trans('button.new_drink')) }}</a>
      </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_dishes')) }}</b></h4>

                <datatable route='products' :collection="$products" :fields="[
                'ID' => 'id',
                'datatable.headers.name' => 'translate:name',
                'datatable.headers.type'  => 'color:type:color_type',
                'datatable.headers.brand' => 'company:name',
               'datatable.headers.restaurant' => 'restaurant:name',
                'datatable.headers.status' => 'status_product'
                ]"
                actions="edit, delete" />

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $('#datatable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
            }

        });

    });

</script>
@endpush
