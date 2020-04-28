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
<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('users.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">{{ ucfirst(trans('button.new_user')) }}</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_users')) }}</b></h4>

              <datatable route='users' :collection='$users' :fields="[
                  'ID'        => 'id',
                  'Name'      => 'name',
                  'Email'     => 'email',
                  'Role'      => 'role'
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
