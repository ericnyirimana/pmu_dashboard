@extends('admin.layouts.master')

@section('content')

<form class="row card-box" method="post" enctype="multipart/form-data" action="{{ route('media.update', $media) }}">
      @csrf
      @method('PUT')
      @include('admin.media.form')

</form>
@include('admin.components.modal-remove')

@endsection
@push('scripts')
<!-- Bootstrap fileupload js -->
<script src="{{ asset("/plugins/bootstrap-fileupload/bootstrap-fileupload.js")}}"></script>
<script type="text/javascript">
    $(document).ready(function() {

    $(document).on('click', '.rm-register', function(){

            var id = $(this).data('register');
            var name = $(this).data('name');

            $('.register-name').text(name);

            $('.rm-accept').attr('action', '/media/'+id);
    });

});
</script>
@endpush
