@extends('admin.layouts.master')

@section('content')


@include('components.notification')

@if(Auth::user()->is_super)
<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('companies.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.new_company')) }}</a>
    </div>
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_companies')) }}</b></h4>
                @if(Auth::user()->is_super)
                <datatable route='companies' :collection="$companies" :fields="[
                'ID' => 'id',
                'datatable.headers.name' => 'name',
                'datatable.headers.number_restaurants' => 'restaurants_quantity',
                'datatable.headers.owner' => 'owner_name',
                'datatable.headers.status' => 'boolean:status_name:status_color'
                ]"
                           actions='view, edit, delete'/>
                @elseif(Auth::user()->is_owner)
                <datatable route='companies' :collection="$companies" :fields="[
                'ID' => 'id',
                'datatable.headers.name' => 'name',
                'datatable.headers.number_restaurants' => 'restaurants_quantity',
                'datatable.headers.owner' => 'owner_name',
                'datatable.headers.status' => 'boolean:status_name:status_color'
                ]"
                           actions='view, edit'/>
                @elseif(Auth::user()->is_restaurant)
                <datatable route='companies' :collection="$companies" :fields="[
                'ID' => 'id',
                'datatable.headers.name' => 'name',
                'datatable.headers.number_restaurants' => 'restaurants_quantity',
                'datatable.headers.owner' => 'owner_name',
                'datatable.headers.status' => 'boolean:status_name:status_color'
                ]"
                       actions='view'/>
                @endif
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
