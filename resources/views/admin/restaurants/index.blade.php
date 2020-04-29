@extends('admin.layouts.master')

@section('content')


@include('components.notification')


<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_restaurants')) }}</b></h4>

                <datatable route='restaurants' :collection="$restaurants" :fields="[
                'ID' => 'id',
                'datatable.headers.name' => 'name',
                'datatable.headers.city' => 'city'
                ]"
                actions='edit' />
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $('#datatable').DataTable({
            "language": {
                "url": "cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
            }

        });

    });

</script>
@endpush
