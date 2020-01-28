<div class="row">

  <div class="col-12 col-md-6">
        @if($product->id)
        <field-select label="Company" field="brand_id" type="relation" :model="$product" :values="$product->brand" foreignid="brand_id" required />
        @else
        <field-select label="Company" field="brand_id" type="relation" :model="$product" :values="$brands" foreignid="brand_id" required />
        @endif
  </div>
  <div class="col-12 col-md-6">
        @if($product->id)
        <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$product" :values="$product->restaurant" foreignid="restaurant_id" required />
        @else
        <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$product" foreignid="restaurant_id" required />
        @endif
  </div>

    <div class="col-lg-9 col-md-7">
          <field-text label="Name" field="name" :model="$product->translation" required  />
    </div>
    <div class="col-lg-3 col-md-5">
          <field-text-group label="Price" field="price" :model="$product" mask="99,99" prepend="€" required />
    </div>
    <div class="col-12">
          <field-tags label="Categories" field="categories" values="categories_array" :model="$product->translation" :list="$categories['foods']" required  />
    </div>
    <div class="col-12 col-md-6">
          <field-area label="Description" field="description" :model="$product->translation" required  />
    </div>
    <div class="col-12 col-md-6">
          <field-area label="Ingredients" field="ingredients" :model="$product->translation" required  />
    </div>
    <div class="col-12">
          <field-tags label="Allergens" field="allergens" values="allergens_array" :model="$product->translation" :list="$categories['allergens']" required  />
    </div>
    <div class="col-12">
          <field-tags label="Diets" field="dietary" values="dietary_array" :model="$product->translation" :list="$categories['dietary']" required  />
    </div>

    <div class="col-4">
          <field-media-list label="Image" field="media_id" :model="$product" required="new" />
    </div>

</div>

<div class="d-flex flex-row row mt-5">
  <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">Save</button>
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
