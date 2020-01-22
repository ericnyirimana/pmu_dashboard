<div class="d-flex flex-row ">
    <div class="col-lg-5 col-md-12">

          <field-text label="Name" field="name" :model="$menu" required  />

    </div>
    <div class="col-lg-4 col-md-12">

          <field-select label="Company" field="brand" type="relation" :model="$menu" :values="$brands" foreignid="brand_id" />

    </div>
    <div class="col-lg-3 col-md-12">

          <field-select label="Company" field="brand" type="relation" :model="$menu" :values="$brands" foreignid="brand_id" />

    </div>
</div>


@include('admin.menu.parts.menu-dish')


<div class="d-flex flex-row row mt-5">
    <div class="col-12">

          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Add Type of plate</button>

    </div>
</div>


<div class="d-flex flex-row row mt-5">
  <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">Save</button>
        </div>
  </div>
</div>
@include('admin.menu.parts.modal-type-dish')
@endsection