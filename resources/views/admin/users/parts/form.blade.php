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
    <div class="col-12 col-md-6">
        <field-select label="Company" field="brand_id" foreignid="id" fieldname="brand_id" type="relation"
                      :model="$user->brand->first()"
                      :values="$user->brand" />
    </div>
    <div class="col-12 col-md-6">

        <field-select label="Restaurant" field="restaurant_id" fieldname="restaurant_id" foreignid="id" type="relation"
                      :model="$user->restaurant->first()"
                      :values="$user->restaurant" />
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

      $(document).on('change', '#role', function(){

          loadCompany( $(this).val() );

      });

      $(document).on('change', '#brand_id', function(){

          loadRestaurants( $(this).val() );

      });


  });

  function loadCompany(id) {
      if (id === 'OWNER' || id === 'RESTAURATEUR') {

          $.ajax({
              url: "{{ route('company.data') }}",
              type: 'GET',
              success: function(data) {

                  $("#brand_id").html('');

                  $.each(data, function(i, company){

                      $("#brand_id").append('<option value="' + company.id + '">' + company.name + '</option>')
                  });
              }
          });

      }
  }

  function loadRestaurants(id) {
      if (id) {

          $.ajax({
              url: "{{ route('company.restaurants.data') }}/"+id,
              type: 'GET',
              success: function(data) {

                  $("#restaurant_id").html('');

                  $.each(data, function(i, company){

                      $("#restaurant_id").append('<option value="' + company.id + '">' + company.name + '</option>')
                  });
              }
          });

      }
  }
  </script>
  @endpush
