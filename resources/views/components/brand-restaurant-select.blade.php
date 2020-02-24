<div class="col-6 col-md-6">
    @if(Auth::user()->is_super && $model->id)
    <field-select label="Company" field="brand_id" foreignid="id" type="simple" :model="$model->brand" :values="$brands->pluck('name', 'id')" required  />
    @elseif(Auth::user()->is_super && !$model->id)
    <field-select label="Company" field="brand_id" foreignid="id" type="simple" :model="$model" :values="$brands->pluck('name', 'id')" required  />
    @elseif($model->id)
    <field-select label="Company" field="brand_id" foreignid="id" type="simple" :model="$model->brand" :values="[$model->brand->id => $model->brand->name]"  required disabled />
    @else
    <field-select label="Company" field="brand_id" foreignid="id" type="simple" :model="Auth::user()->brand" :values="[Auth::user()->brand->id => Auth::user()->brand->name]"  required disabled />
    @endif
</div>
<div class="col-6 col-md-6">
    @if(Auth::user()->is_super && $model->id)
    <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$model" :values="$model->brand->restaurants" foreignid="restaurant_id" required />
    @elseif(Auth::user()->is_super && !$model->id)
    <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$model" :values="[]" foreignid="restaurant_id" required />
    @elseif(!$model->id)
    <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$model" :values="Auth::user()->brand->restaurants" foreignid="restaurant_id" required />
    @elseif(Auth::user()->is_owner)
    <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$model" :values="$model->brand->restaurants" foreignid="restaurant_id" required />
    @else
    <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$model" :values="$model->restaurant" foreignid="restaurant_id" required disabled />
    @endif
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
