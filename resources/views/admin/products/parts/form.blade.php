<div class="row">
    <div class="col-lg-6 col-md-12">
          <field-select label="Company" field="brand_id" type="relation" :model="$product" :values="$brands" foreignid="brand_id" />
    </div>
    <div class="col-lg-6 col-md-12">
          <field-select label="Company" field="restaurant_id" type="relation" :model="$product" :values="$restaurants" foreignid="restaurant_id" />
    </div>

    <div class="col-lg-9 col-md-7">
          <field-text label="Name" field="name" :model="$product" required  />
    </div>
    <div class="col-lg-3 col-md-5">
          <field-text label="Price" field="price" :model="$product" required  />
    </div>
    <div class="col-12">
          <field-text label="Categories" field="categories" :model="$product" required  />
    </div>
    <div class="col-12 col-md-6">
          <field-area label="Description" field="description" :model="$product" required  />
    </div>
    <div class="col-12 col-md-6">
          <field-area label="Ingredients" field="ingredients" :model="$product" required  />
    </div>
    <div class="col-12">
          <field-text label="Allergens" field="allergens" :model="$product" required  />
    </div>
    <div class="col-12">
          <field-text label="Diets" field="diets" :model="$product" required  />
    </div>

    <div class="col-4">
          <field-media label="Image" field="media_id" :model="$product" :media="$media" required="new" />
    </div>

</div>

<div class="d-flex flex-row row mt-5">
  <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">Save</button>
        </div>
  </div>
</div>
