@extends('admin.layouts.master')

@section('content')

@include('admin.components.fields-require-alert')

@if (isset($user))
<tag-form file :action="route('users.update', $user)" method="put" >
@else
<tag-form file :action="route('users.store')">
@endif
      <div class="d-flex flex-row">

          <div class="col-12 d-flex flex-column">

                <field-text label="Name" field="name" :model="$user" required  />

            
                <div class="form-group mt-auto">

                    <button type="submit" class="btn btn-md w-lg btn-success float-right">Save</button>

                </div>

          </div>

</tag-form>

@include('admin.components.modal-remove')

@endsection

@push('styles')
<!-- Jquery filer css -->
<link href="{{ asset("/plugins/bootstrap-fileupload/bootstrap-fileupload.css")}}" rel="stylesheet" />
@endpush
@push('scripts')
<!-- Bootstrap fileupload js -->
<script type="text/javascript" src="{{ asset("/plugins/bootstrap-fileupload/bootstrap-fileupload.js")}}"></script>

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
