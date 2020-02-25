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


    <div class="col-8">
          <label>COMBO</label>

          <p>@if($pickup->sections) @php print implode(' + ', array_keys($pickup->sections) ); @endphp @endif</p>
    </div>
    <div class="col-2">
          <field-text label="q.tà abbonamenti (x giorno)" field="quantity_offer" :model="$pickup" class="text-right" />
    </div>
    <div class="col-2">
          <field-text label="Numero offerte (x giorno)" field="quantity_per_subscription" :model="$pickup" class="text-right" />
    </div>


</div>
