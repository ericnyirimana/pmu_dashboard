@extends('admin.layouts.master')

@section('content')


@include('components.notification')
<div class="row m-b-10 card-box ">

    <div class="col-md-8 col-lg-10">
        <h2>{{ $media->name }} <span class="edit-view"></span></h2>
          <p>{{ $media->getImageSize('medium') }}</p>
          <img src="{{ $media->getImageSize('medium') }}" class="rounded" />


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
