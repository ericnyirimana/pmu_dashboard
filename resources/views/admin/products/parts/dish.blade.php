<div class="col-lg-9 col-md-7">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit))
      <field-text label="name" field="name" :model="$product->translate" required disabled/>
@else
      <field-text label="name" field="name" :model="$product->translate" required/>
@endif
</div>
<div class="col-lg-3 col-md-5">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit))
      <field-text-group label="price" field="price" :model="$product" mask="#,##" maskreverse="true" prepend="€"
                        required disabled/>
@else
      <field-text-group label="price" field="price" :model="$product" mask="#,##" maskreverse="true" prepend="€"
                        required/>
@endif
</div>
<div class="col-12">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit))
      <field-tags label="food" field="foods" :values="$product->foods->pluck('translate.name')" :list="$foods"
                  required  disabled/>
@else
      <field-tags label="food" field="foods" :values="$product->foods->pluck('translate.name')" :list="$foods"
                  required/>
@endif
</div>
<div class="col-12 col-md-6">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit))
      <field-area label="description" field="description" id="dish-description" :model="$product->translate"  disabled/>
@else
      <field-area label="description" field="description" id="dish-description" :model="$product->translate"/>
@endif
</div>
<div class="col-12 col-md-6">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit))
      <field-area label="ingredients" field="ingredients" :model="$product->translate"  disabled/>
@else
      <field-area label="ingredients" field="ingredients" :model="$product->translate"/>
@endif
</div>
<div class="col-12">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit))
      <field-tags label="allergens" field="allergens" :values="$product->allergens->pluck('translate.name')"
                  :list="$allergens" disabled/>
@else
      <field-tags label="allergens" field="allergens" :values="$product->allergens->pluck('translate.name')"
                  :list="$allergens"/>
@endif
</div>
<div class="col-12">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit))
      <field-tags label="dietaries" field="dietaries" :values="$product->dietaries->pluck('translate.name')"
                  :list="$dietaries" disabled/>
@else
      <field-tags label="dietaries" field="dietaries" :values="$product->dietaries->pluck('translate.name')"
                  :list="$dietaries"/>
@endif
</div>
