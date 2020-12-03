<div class="row">
    <!-- <div class="col-12 col-md-6">
        @if($pickup->orders->count() > 0)
            <field-select label="price_range" field="price" :model="$pickup" type="simple" :values="['7' => '7 €', '14' =>
      '14 €' ]"  required disabled />
            <input type="hidden" value="{{ $pickup->price }}" name="price">
        @else
            <field-select label="price_range" field="price" :model="$pickup" type="simple" :values="['7' => '7 €', '14' =>
      '14 €' ]"  required />
        @endif
    </div> -->
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="price_quantity">{{ __('labels.price') }}</label>
        <select id="price_quantity" class="form-control" name="price_quantity"
                aria-describedby="price_quantityHelp" parsley-trigger="change" required @if($pickup->orders->count() > 0 && !Auth::user()->is_super) disabled @endif>
            <option value="">{{ __('labels.select') }} {{ __('labels.price_range') }}</option>
            <option value="5 pasti a 30 €">5 pasti a 30 €</option>
            <option value="5 pasti a 60 €">5 pasti a 60 €</option>
            <option value="10 pasti a 60 €">10 pasti a 60 €</option>
        </select>
        <input type="hidden" value="{{ $pickup->price }}" name="price" id="price">
        <input type="hidden" value="{{ $pickup->quantity_per_subscription }}" name="quantity_per_subscription" id="quantity_per_subscription">
        </div>
    </div>
    <div class="col-12 col-md-6">
        @if($pickup->orders->count() > 0)
            <field-select label="subscription_validity" field="validate_months" :model="$pickup" type="simple" :values="$month_validity" required disabled/>
        @else
            <field-select label="subscription_validity" field="validate_months" :model="$pickup" type="simple" :values="$month_validity" required/>
        @endif

    </div>
    <!-- <div class="col-12 col-md-6">
          <field-select label="quantity_per_subscription" field="quantity_per_subscription" :model="$pickup"
                        type="simple"
                        :values="$subscription_items" />
    </div> -->
</div>

@include('admin.pickups.parts.products')

<div class="row card-box bg-light p-3 mt-4 mr-1 ml-1">
    <div class="col-8">
          <label>COMBO</label>

          <p>@if($pickup->sections) @php print implode(' + ', array_keys($pickup->sections) ); @endphp @endif</p>
    </div>
    <div class="col-4">
          <field-text label="subscriptions_number" field="quantity_offer" :model="$pickup" class="text-right" />
    </div>
</div>

<div class="row">
    <div class="col-4">
        <field-media-list label="image" field="media_id" :model="$pickup" required />
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            loadPriceQuantity();
            $(document).on('change', '#price_quantity', function () {
                if(($('#price_quantity').val()).length){
                    if($('#price_quantity').val() === '5 pasti a 30 €'){
                        $('input[name="price"]').val('7');
                        $('input[name="quantity_per_subscription"]').val('5');
                    }
                    else if($('#price_quantity').val() === '5 pasti a 60 €'){
                        $('input[name="price"]').val('14');
                        $('input[name="quantity_per_subscription"]').val('5');
                    }
                    else if($('#price_quantity').val() === '10 pasti a 60 €'){
                        $('input[name="price"]').val('7');
                        $('input[name="quantity_per_subscription"]').val('10');
                    }
                    else{
                        $('input[name="price"]').val('');
                        $('input[name="quantity_per_subscription"]').val('');
                    }
                }
                else{
                    $('input[name="price"]').val('');
                    $('input[name="quantity_per_subscription"]').val('');
                }
            }); 
        });

        function loadPriceQuantity() {
            var price = $('input[name="price"]').val();
            var quantity = $('input[name="quantity_per_subscription"]').val();
            if(price === '7.00' && quantity === '5'){
                $('#price_quantity').val('5 pasti a 30 €');
            }
            else if(price === '14.00' && quantity === '5'){
                $('#price_quantity').val('5 pasti a 60 €');
            }
            else if(price === '7.00' && quantity === '10'){
                $('#price_quantity').val('10 pasti a 60 €');
            }
            else{
                $('#price_quantity').val('');
            }
        }
    </script>
@endpush