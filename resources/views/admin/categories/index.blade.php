@extends('admin.layouts.master')

@section('content')


@include('admin.components.notification')

<div class="row m-b-10">
      <div class="col-12">
          <a href="{{ route('categories.create' )}}" class="btn btn-success waves-effect w-md waves-light pull-right">New Category</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>List categories</b></h4>

                <datatable route='categories' :collection="$categories" :fields="[
                'ID' => 'id',
                'Name' => 'translation:name',
                'Type' => 'type:name',
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


        });

    });

</script>
@endpush
