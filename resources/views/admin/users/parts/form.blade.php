<div class="row">

    <div class="col-12 col-md-6">
          <field-text label="Name" field="name" :model="$user" required  />
    </div>
    <div class="col-12 col-md-6">
          <field-text label="Email" field="email" :model="$user" disabled required />
    </div>
    <div class="col-12 col-md-6">

          <field-select label="Role" field="role" foreignid="role" type="simple" :model="$user" :values="config('cognito.roles')" required />
    </div>
    <div class="col-12">
          <div class="form-group mt-auto">

              <a href="{{ route('users.index') }}" class="btn btn-md w-lg btn-secondary float-left">Cancel</a>
              <button type="submit" class="btn btn-md w-lg btn-success float-right">Save</button>

          </div>

    </div>
  </div>
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
