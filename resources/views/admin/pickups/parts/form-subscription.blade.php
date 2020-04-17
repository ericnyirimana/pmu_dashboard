<div class="row">
    <div class="col-12 col-md-6">
        <field-select label="Price range" field="price" :model="$pickup" type="simple" :values="['7' => '7 €', '14' => '14 €' ]"  required  />
    </div>
    <div class="col-12 col-md-6">
        <field-select label="Validate Days" field="validate_days" :model="$pickup" type="simple" :values="['5' => '5 Days', '10' => '10 Days', '20' => '20 Days' ]"  required  />
    </div>
</div>

@include('admin.pickups.parts.products')

<div class="row card-box bg-light p-3 mt-4 mr-1 ml-1">
    <div class="col-6">
          <label>COMBO</label>

          <p>@if($pickup->sections) @php print implode(' + ', array_keys($pickup->sections) ); @endphp @endif</p>
    </div>
    <div class="col-3">
          <field-text label="Q.tà abbonamenti (x giorno)" field="quantity_offer" :model="$pickup" class="text-right" />
    </div>
    <div class="col-3">
          <field-select label="Numero offerte (x abbonamento)" field="quantity_per_subscription" :model="$pickup" type="simple" :values="['5' => '5', '10' => '10']" />
    </div>
</div>

<div class="row">
    <div class="col-4">
        <field-media-list label="Image" field="media_id" :model="$pickup" required />
    </div>
</div>
