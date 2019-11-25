@extends('admin.layouts.master')

@section('content')


@include('admin.components.notification')
<div class="row m-b-10">
      <div class="col-12">
          <div class="card-box">
          Info
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>List restaurants</b></h4>
                <datatable route='restaurants' :collection="$brand->restaurants" :fields="[
                'ID' => 'id',
                'Name' => 'name',
                'City' => 'city'
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
