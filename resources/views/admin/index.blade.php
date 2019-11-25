@extends('admin.layouts.master')

@section('content')

@include('admin.components.notification')

<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('users.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">New User</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>List users</b></h4>
            @php $list = [
                'ID'        => 'id',
                'Name'      => 'full_name',
                'Email'     => 'email'
            ];
            @endphp
              <datatable route='users' :collection='$users' :fields="$list" />

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
