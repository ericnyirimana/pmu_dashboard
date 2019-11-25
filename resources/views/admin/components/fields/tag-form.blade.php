<form class="card-box" method="post" @if(isset($file)) enctype="multipart/form-data" @endif action="{{ $action }}">
      @csrf
      @if (isset($method))
          @method($method)
      @endif

      {{ $slot }}
</form>
@push('scripts')
<!-- Parsley js -->
<script type="text/javascript" src="{{ asset("/plugins/parsleyjs/parsley.min.js")}}"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('form').parsley();

    $(document).on('click', '.rm-register', function(){

            var id = $(this).data('register');
            var name = $(this).data('name');

            $('.register-name').text(name);

            $('.rm-accept').attr('action', '/media/'+id);
    });

});
</script>
@endpush
