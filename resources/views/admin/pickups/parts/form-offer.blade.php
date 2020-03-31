<div class="col-12 col-md-4">
      <field-select label="Price range" field="price" :model="$pickup" type="simple" :values="['7' => '7 €', '14' => '14 €' ]"  required  />
</div>

@include('admin.pickups.parts.products')

<div class="row card-box bg-light p-3 mt-4 mr-1 ml-1">
    <div class="col-10">
          <label>COMBO</label>
          <p>@if($pickup->sections) @php print implode(' + ', array_keys($pickup->sections) ); @endphp @endif</p>
    </div>
    <div class="col-2">
          <field-text label="Numero offerte (x giorno)" field="quantity_offer" :model="$pickup" class="text-right" />
    </div>
</div>

<div class="row">
    <div class="col-4">
        <field-media-list label="Image" field="media_id" :model="$pickup" required="new" />
    </div>
</div>
