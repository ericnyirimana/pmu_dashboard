@extends('admin.layouts.master')

@section('content')


@include('admin.components.notification')

<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('brands.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">New Media</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>List brands</b></h4>

                <datatable route='brands' :collection="$brands" :fields="[
                'ID' => 'id',
                'Name' => 'name',
                'N. Restaurants' => 'restaurants_quantity',
                'Owner' => 'owner_name',
                'Status' => 'boolean:status_name:status_color'
                ]" />
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
