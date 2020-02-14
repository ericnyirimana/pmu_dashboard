<div class="d-flex flex-row row">
    <div class="col-md-12 col-lg-6">

          <field-text label="Name" field="name" :model="$category->translation" required  />

          <field-media label="Image" field="media_id" :model="$category" required="new" />

    </div>
    <div class="col-md-12 col-lg-6 d-flex flex-column">

          <field-select label="Food Category" field="type" foreignid="type" type="simple" :model="$category" :values="['Food'=>'Food', 'Allergen'=>'Allergen', 'Dietary'=>'Dietary']" required />

          <field-area label="Description" field="description" :model="$category->translation" required  />

    </div>
</div>
<div class="d-flex flex-row row">
  <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">Save</button>
        </div>
  </div>
</div>
