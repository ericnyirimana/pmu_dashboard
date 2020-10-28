@extends('admin.layouts.master')

@section('content')

@if (session('notification') )
  @component('components.notification')
      @slot('type')
          {{ session('type-notification') }}
      @endslot
      {{ session('notification') }}
  @endcomponent
@endif

@if(Auth::user()->is_super)
<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('users.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.new_user')) }}</a>
    </div>
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_users')) }}</b></h4>
            @if (Auth::user()->is_manager || Auth::user()->is_owner || Auth::user()->is_restaurant)
              <datatable route='users' :collection='$users' :fields="[
                  'ID'        => 'id',
                  'datatable.headers.name'      => 'name',
                  'datatable.headers.email'     => 'email',
                  'datatable.headers.role'      => 'role',
                  'datatable.headers.brand'      => 'brand_name',
                  'datatable.headers.restaurant'      => 'restaurant_name'
              ]"
              actions="edit" />
            @else
             <datatable route='users' :collection='$users' :fields="[
                  'ID'        => 'id',
                  'datatable.headers.name'      => 'name',
                  'datatable.headers.email'     => 'email',
                  'datatable.headers.role'      => 'role',
                  'datatable.headers.brand'      => 'brand_name',
                  'datatable.headers.restaurant'      => 'restaurant_name'
              ]"
              actions="edit, delete" />
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
