@extends('admin.layouts.master')

@section('content')

@include('admin.components.notification')
<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('products.create.dish' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">New Dish</a>
          <a href="{{ route('products.create.drink' )}}" class="btn btn-success waves-effect w-md waves-light pull-right mr-3">New Drink</a>
      </div>

</div>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>List dishes</b></h4>

                <datatable route='products' :collection="$products" :fields="[
                'ID' => 'id',
                'Name' => 'translation:name',
                'type'  => 'type'
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
