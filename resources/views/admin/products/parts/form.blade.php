<div class="row">

    <div class="col-lg-9 col-md-7">
          <field-text label="Name" field="name" :model="$product" required  />
    </div>
    <div class="col-lg-3 col-md-5">
          <field-text-group label="Price" field="price" :model="$product" mask="99,99" prepend="€" required />
    </div>
    <div class="col-12">
          <field-tags label="Categories" field="categories" :model="$product" :values="$categories['foods']" required  />
    </div>
    <div class="col-12 col-md-6">
          <field-area label="Description" field="description" :model="$product" required  />
    </div>
    <div class="col-12 col-md-6">
          <field-area label="Ingredients" field="ingredients" :model="$product" required  />
    </div>
    <div class="col-12">
          <field-tags label="Allergens" field="allergens" :model="$product" :values="$categories['allergens']" required  />
    </div>
    <div class="col-12">
          <field-tags label="Diets" field="diets" :model="$product" :values="$categories['dietary']" required  />
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
