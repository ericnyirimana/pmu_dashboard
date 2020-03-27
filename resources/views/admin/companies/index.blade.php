@extends('admin.layouts.master')

@section('content')


@include('components.notification')

<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('companies.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">New Company</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>List companies</b></h4>

                <datatable route='companies' :collection="$companies" :fields="[
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
