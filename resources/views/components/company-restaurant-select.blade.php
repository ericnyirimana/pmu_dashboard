<div class="col-6 col-md-6">
    @if(Auth::user()->is_super && $model->id)
    <field-select label="Company" field="brand_id" foreignid="id" type="simple" :model="$model->company" :values="$companies->pluck('name', 'id')" required  />
    @elseif(Auth::user()->is_super && !$model->id)
    <field-select label="Company" field="brand_id" foreignid="id" type="simple" :model="$model" :values="$companies->pluck('name', 'id')" required  />
    @elseif($model->id)
    <field-select label="Company" field="brand_id" foreignid="id" type="simple" :model="$model->company" :values="[$model->company->id => $model->company->name]"  required disabled />
    @else
    <field-select label="Company" field="brand_id" foreignid="id" type="simple" :model="Auth::user()->company" :values="[Auth::user()->company->id => Auth::user()->company->name]"  required disabled />
    @endif
</div>
<div class="col-6 col-md-6">
    @if(Auth::user()->is_super && $model->id)
    <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$model" :values="$model->company->restaurants" foreignid="restaurant_id" required />
    @elseif(Auth::user()->is_super && !$model->id)
    <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$model" :values="[]" foreignid="restaurant_id" required />
    @elseif(!$model->id)
    <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$model" :values="Auth::user()->company->restaurants" foreignid="restaurant_id" required />
    @elseif(Auth::user()->is_owner)
    <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$model" :values="$model->company->restaurants" foreignid="restaurant_id" required />
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
              url: "{{ route('company.restaurants.data') }}/"+$(this).val(),

              type: 'GET',
              success: function(data) {

                  $("#restaurant_id").html('');

                  $.each(data, function(i, restaurant){
                      $("#restaurant_id").append('<option value="' + restaurant.id + '">' + restaurant.name + '</option>');
                  });

                  $("#restaurant_id").trigger('change');
              }
          });

        } else {
          $("#restaurant_id").html('<option>Select Company first</option>');
        }

    });

});
</script>
@endpush
