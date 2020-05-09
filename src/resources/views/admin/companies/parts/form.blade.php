<div class="d-flex flex-row row">
    <div class="col-md-12 col-lg-6">

          <field-text label="Name" field="name" :model="$company" required  />

          <field-text label="VAT" field="vat" :model="$company" required  />

          <field-media label="Image" field="media_id" :model="$company" required="new" />

    </div>
    <div class="col-md-12 col-lg-6 d-flex flex-column">

          <field-text label="Corporate Name" field="corporate_name" :model="$company" required  />

          @can('create', $company)
          <field-select label="Owner" field="owner" type="relation" :model="$company" :values="$users" foreignid="owner_id" />
          @endcan
          <field-area label="Description" field="description" :model="$company"  />

          <field-switch label="Active" field="status" :model="$company" color="#039cfd" required  />

    </div>
</div>
<div class="d-flex flex-row row">
  <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">{{ ucfirst(trans('button.save')) }}</button>
        </div>
  </div>
</div>
