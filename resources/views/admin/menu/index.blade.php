@extends('admin.layouts.master')

@section('content')


@include('admin.components.notification')

<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('menu.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">New Menu</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>List menu</b></h4>

                <datatable route='menu' :collection="$menu" :fields="[
                'ID' => 'id',
                'Name' => 'name',
                'Company' => 'brand:name',
                'ristorante' => 'restaurant:name',
                'Status' => 'boolean:status_name:status_color'
                ]"
                actions="edit,delete" />
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
