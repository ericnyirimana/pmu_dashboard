<div class="row">
    <div class="col-12 col-md-6">
        @if($pickup->orders->count() > 0)
            <field-select label="price_range" field="price" :model="$pickup" type="simple" :values="['7' => '7 €', '14' =>
      '14 €' ]"  required disabled />
        @else
            <field-select label="price_range" field="price" :model="$pickup" type="simple" :values="['7' => '7 €', '14' =>
      '14 €' ]"  required />
        @endif
    </div>
    <div class="col-12 col-md-6">
        @if(isset($pickup->validate_days) && $pickup->validate_days == 40 && $pickup->orders->count() > 0)
            <field-select label="validate_days" field="validate_days" :model="$pickup" type="simple" :values="['40' => '40 Days']" required />
        @else
            <field-select label="validate_days" field="validate_days" :model="$pickup" type="simple" :values="['20' =>
        '20 Days', '40' => '40 Days']" required />
        @endif

    </div>
</div>

@include('admin.pickups.parts.products')

<div class="row card-box bg-light p-3 mt-4 mr-1 ml-1">
    <div class="col-6">
          <label>COMBO</label>

          <p>@if($pickup->sections) @php print implode(' + ', array_keys($pickup->sections) ); @endphp @endif</p>
    </div>
    <div class="col-3">
          <field-text label="subscriptions_number" field="quantity_offer" :model="$pickup" class="text-right" />
    </div>
    <div class="col-3">
          <field-select label="quantity_per_subscription" field="quantity_per_subscription" :model="$pickup"
                        type="simple"
                        :values="['5' => '5', '10' => '10']" />
    </div>
</div>

<div class="row">
    <div class="col-4">
        <field-media-list label="image" field="media_id" :model="$pickup" required />
    </div>
</div>
