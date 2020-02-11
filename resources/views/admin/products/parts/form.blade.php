<div class="row">

  <div class="col-12">
      <h4>{{ $product->type }}</h4>
      <field-hide field="type" :model="$product" />
  </div>

  <div class="col-6 col-md-4">
      @if(Auth::user()->is_super && $product->id)
      <field-select label="Company" field="id" type="simple" :model="$product->brand" :values="$brands->pluck('id', 'name')" required  />
      @elseif(Auth::user()->is_super && !$product->id)
      <field-select label="Company" field="id" type="simple" :model="$product" :values="$brands->pluck('id', 'name')" required  />
      @elseif($product->id)
      <field-select label="Company" field="id" type="simple" :model="$product->brand" :values="[$product->brand->name => $product->brand->id]"  required disabled />
      @else
      <field-select label="Company" field="id" type="simple" :model="Auth::user()->brand" :values="[Auth::user()->brand->name => Auth::user()->brand->id]"  required disabled />
      @endif
  </div>
  <div class="col-6 col-md-4">
      @if(Auth::user()->is_super && $product->id)
      <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$product" :values="$product->brand->restaurants" foreignid="restaurant_id" required />
      @elseif(Auth::user()->is_super && !$product->id)
      <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$product" :values="[]" foreignid="restaurant_id" required />
      @elseif(!$product->id)
      <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$product" :values="Auth::user()->brand->restaurants" foreignid="restaurant_id" required />
      @elseif(Auth::user()->is_owner)
      <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$product" :values="$product->brand->restaurants" foreignid="restaurant_id" required />
      @else
      <field-select label="Restaurant" field="restaurant_id" type="relation" :model="$product" :values="$product->restaurant" foreignid="restaurant_id" required disabled />
      @endif
  </div>

</div>
<div class="row">
  @if($product->type == 'Dish')
    @include('admin.products.parts.dish')
  @endif
  @if($product->type == 'Drink')
    @include('admin.products.parts.drink')
  @endif
</div>

<div class="row">
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
