<div class="d-flex flex-row row">
    <div class="col-md-12 col-lg-6">
        @if(Auth::user()->is_manager)
          <field-text label="name" field="name" :model="$company" required disabled/>
          <field-text label="vat" field="vat" :model="$company" required disabled/>
          <field-media label="Image" field="media_id" :model="$company" required="new" disabled/>
        @else
            <field-text label="name" field="name" :model="$company" required />
            <field-text label="vat" field="vat" :model="$company" required />
            <field-media label="Image" field="media_id" :model="$company" required="new" />
        @endif
    </div>
    <div class="col-md-12 col-lg-6 d-flex flex-column">
        @if(Auth::user()->is_manager)
          <field-text label="corporate_name" field="corporate_name" :model="$company" required disabled/>
          @can('create', $company)
          <field-select label="Owner" field="owner" type="relation" :model="$company" :values="$users"
                        foreignid="owner_id" disabled />
          @endcan
          <field-area label="Description" field="description" :model="$company" disabled />
          <field-switch label="Active" field="status" :model="$company" color="#039cfd" required disabled />
        @else
            <field-text label="corporate_name" field="corporate_name" :model="$company" required />
            @can('create', $company)
                <field-select label="Owner" field="owner" type="relation" :model="$company" :values="$users"
                              foreignid="owner_id" />
            @endcan
            <field-area label="Description" field="description" :model="$company" />
            <field-switch label="Active" field="status" :model="$company" color="#039cfd" required />
        @endif
    </div>
</div>
<div class="d-flex flex-row row">
  <div class="col-12">
        <div class="form-group">
            @if(Auth::user()->is_manager)
            <button type="submit" class="btn btn-block w-lg btn-success float-right" disabled="disabled">{{ ucfirst(trans('button.save')
            ) }}</button>
            @else
                <button type="submit" class="btn btn-block w-lg btn-success float-right">{{ ucfirst
                (trans
                ('button.save')
            ) }}</button>
            @endif

        </div>
  </div>
</div>
