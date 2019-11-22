@extends('admin.layouts.master')

@section('content')


@include('admin.components.notification')

<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('media.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">New Media</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>List media</b></h4>

              <datatable route='media' :collection='$media' />

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
