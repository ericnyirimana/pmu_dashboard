<div class="row">

  <div class="col-12">
      <h4>{{ $product->type }}</h4>
      <field-hide field="type" :model="$product" />
  </div>

</div>
<div class="row">
  <company-restaurant-select :model="$product" />
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
