<div class="row">
    <div class="col-12 col-md-4">
          <field-text label="Name" field="name" :model="$menu" required  />
    </div>
    <div class="col-6 col-md-4">
        @if(Auth::user()->is_super && $menu->id)
        <field-select label="Company" field="id" type="simple" :model="$menu->brand" :values="$brands->pluck('id', 'name')" required  />
        @elseif(Auth::user()->is_super && !$menu->id)
        <field-select label="Company" field="id" type="simple" :model="$menu" :values="$brands->pluck('id', 'name')" required  />
        @elseif($menu->id)
        <field-select label="Company" field="id" type="simple" :model="$menu->brand" :values="[$menu->brand->name => $menu->brand->id]"  required disabled />
        @else
        <field-select label="Company" field="id" type="simple" :model="Auth::user()->brand" :values="[Auth::user()->brand->name => Auth::user()->brand->id]"  required disabled />
        @endif
    </div>
    <div class="col-6 col-md-4">
        @if(Auth::user()->is_super && $menu->id)
        <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$menu" :values="$menu->brand->restaurants" foreignid="restaurant_id" required />
        @elseif(Auth::user()->is_super && !$menu->id)
        <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$menu" :values="[]" foreignid="restaurant_id" required />
        @elseif(!$menu->id)
        <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$menu" :values="Auth::user()->brand->restaurants" foreignid="restaurant_id" required />
        @elseif(Auth::user()->is_owner)
        <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$menu" :values="$menu->brand->restaurants" foreignid="restaurant_id" required />
        @else
        <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$menu" :values="$menu->restaurant" foreignid="restaurant_id" required disabled />
        @endif
    </div>
</div>

<div class="row">
  <div class="col-12">
    @include('admin.menu.parts.menu-sections')
  </div>
</div>

@if($menu->id)
<div class="row mt-5">
    <div class="col-12">
          <button type="button" class="btn btn-primary btn-block btn-save-menu"  data-toggle="modal" data-target="#modalTypeDish"><i class="fa fa-plus"></i> Add Type of plate</button>
    </div>
</div>
@endif

<div class="row mt-5">
  <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">@if($menu->id) Save @else Next @endif</button>
        </div>
  </div>
</div>
@push('scripts')
<script>
$(document).ready(function(){


    $(document).on('change', '#brand_id', function(){

        if ($(this).val()) {

          $.ajax({
              url: "{{ route('brand.restaurants.data') }}/"+$(this).val(),

              type: 'GET',
              success: function(data) {

                  $("#restaurant_id").html('');

                  $.each(data, function(i, restaurant){

                      $("#restaurant_id").append('<option value="' + restaurant.id + '">' + restaurant.name + '</option>')
                  });
              }
          });

        } else {
          $("#restaurant_id").html('<option>Select Company first</option>');
        }

    });

});
</script>
@endpush
