<div class="row">

    <div class="col-12 col-md-6">
          <field-text label="name" field="name" :model="$user" required  />
    </div>
    <div class="col-12 col-md-6">
          <field-text label="email" field="email" :model="$user" disabled required />
    </div>
    <div class="col-12 col-md-6">
          <field-select label="Role" field="role" foreignid="role" type="simple" :model="$user" :values="config('cognito.roles')" disabled required />
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
    <div class="col-12 col-md-8">
        {{--<field-image label="Immagine profilo" field="profile_image" :model="$user" />--}}
    </div>
    <div class="col-12 col-md-6 row d-flex align-items-center">
        <div class="col-8">
            <field-text label="password" field="password" {{--:model="$user"--}} />
        </div>
        <div class="col-4">
            <button type="button" class="btn btn-md w-lg btn-success float-right">{{ ucfirst(trans('button.generate_pwd')) }}</button>
        </div>
    </div>
    <div class="col-12">
          <div class="form-group mt-auto">

              <a href="{{ route('users.index') }}" class="btn btn-md w-lg btn-secondary float-left">{{ ucfirst(trans('button.back')) }}</a>
              <button type="submit" class="btn btn-md w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>

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
          $('#brand_id').parsley().removeError('company_owner');
          loadRestaurants( $(this).val() );

      });


  });

  function loadCompany(id) {
      var companyElem = $("#brand_id");
      if (id === 'OWNER' || id === 'RESTAURATEUR') {

          $.ajax({
              url: "{{ route('company.data') }}",
              type: 'GET',
              success: function(data) {

                  companyElem.html('<option value="">Select Company</option>');

                  $.each(data, function(i, company){

                      companyElem.append('<option value="' + company.id + '">' + company.name + '</option>')
                  });
              }
          });

      } else {
          companyElem.html('<option value="">Select Company</option>');
      }
  }

  function loadRestaurants(id) {
      var restaurantElem = $("#restaurant_id");
      if (id) {
          $.ajax({
              url: "{{ route('company.restaurants.data') }}/"+id,
              type: 'GET',
              success: function(data) {

                  restaurantElem.html('<option value="">Select Restaurant</option>');

                  $.each(data, function(i, restaurant){

                      restaurantElem.append('<option value="' + restaurant.id + '">' + restaurant.name + '</option>')
                  });
                  if ($('#role').val() === 'OWNER') {
                      $.ajax({
                          url: "{{ route('company.data') }}/"+id,
                          type: 'GET',
                          success: function(data) {
                              if (data.owner_id != null) {
                                  $('#brand_id').parsley().addError('company_owner', {'message': 'Company ' + data
                                          .name + ' already has an owner'});
                              }

                          }
                      });
                  }
              }
          });
      } else {
          restaurantElem.html('<option value="">Select Restaurant</option>');
      }
  }
  </script>
  @endpush
