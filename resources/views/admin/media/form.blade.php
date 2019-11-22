@include('admin.components.fields-require-alert')
<div class="d-flex flex-row">
<div class="col-md-12 col-lg-6">
    <field-image field="file" :model="$media" />
</div>
<div class="col-md-12 col-lg-6 d-flex flex-column">

      <field-text label="Name" field="name" :model="$media" required  />

      <field-select label="Brand" field="brand" type="relation" field="brand" :model="$media" :values="$brands" foreignid="brand_id" required />

      <div class="form-group mt-auto">

          @if (isset($media))
          <button type="button" class="btn btn-md w-lg btn-danger rm-register" data-name="{{ $media->name }}" data-register="{{ $media->id }}"  data-toggle="modal" data-target=".remove-register">Remove permanently</button>
          @endif
          <button type="submit" class="btn btn-md w-lg btn-success float-right">Save</button>
      </div>

</div>

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
    });
</script>
@endpush
