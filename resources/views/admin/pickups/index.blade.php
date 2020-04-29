@extends('admin.layouts.master')

@section('content')


@include('components.notification')

<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('pickups.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.new_offer')) }}</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_pickups')) }}</b></h4>

                <datatable route='pickups' :collection="$pickups" :fields="[
                'ID'    => 'id',
                'datatable.headers.name'  => 'name',
                'datatable.headers.type'  => 'color:type_pickup:pickup_color'
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
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
            }

        });

    });

</script>
@endpush
