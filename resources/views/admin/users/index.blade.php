@extends('admin.layouts.master')

@section('content')

@if (session('notification') )
  @component('admin.components.notification')
      @slot('type')
          {{ session('type-notification') }}
      @endslot
      {{ session('notification') }}
  @endcomponent
@endif
<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('users.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">New User</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>List users</b></h4>

            @include('admin.components.datatable')

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
