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
                'Nome' => 'translate:name',
                'Tipo'  => 'color:type:color_type',
                'Brand' => 'company:name',
                'Ristorante' => 'restaurant:name',
                'Stato' => 'status'
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


        });

    });

</script>
@endpush
