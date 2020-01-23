<div class="d-flex flex-row row">
    <div class="col-md-12 col-lg-6">

          <field-text label="Name" field="name" :model="$brand" required  />

          <field-text label="VAT" field="vat" :model="$brand" required  />

          <field-media label="Image" field="media_id" :model="$brand" required="new" />

    </div>
    <div class="col-md-12 col-lg-6 d-flex flex-column">

          <field-text label="Corporate Name" field="corporate_name" :model="$brand" required  />

          <field-select label="Owner" field="owner" type="relation" :model="$brand" :values="$users" foreignid="owner_id" />

          <field-area label="Description" field="description" :model="$brand"  />

          <field-switch label="Active" field="status" :model="$brand" color="#039cfd" required  />


    </div>
</div>
<div class="d-flex flex-row row">
  <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">Save</button>
        </div>
  </div>
</div>
