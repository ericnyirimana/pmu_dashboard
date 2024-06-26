<div class="col-lg-6 col-md-12">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit) && !($product->is_draft))
      <field-text label="name" field="name" :model="$product->translate" required disabled/>
@else
      <field-text label="name" field="name" :model="$product->translate" required/>
@endif
</div>
<div class="col-lg-3 col-md-6">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit) && !($product->is_draft))
      <field-text label="capacity" field="description" id="drink-description" :model="$product->translate"
                  mask="#.### ml." maskreverse="true" disabled/>
@else
      <field-text label="capacity" field="description" id="drink-description" :model="$product->translate"
                  mask="#.### ml." maskreverse="true"/>
@endif
</div>
<div class="col-lg-3 col-md-6">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit) && !($product->is_draft))
      <field-text-group label="price" field="price" :model="$product" mask="##,##" maskreverse="true" prepend="€"
                        required disabled/>
@else
      <field-text-group label="price" field="price" :model="$product" mask="##,##" maskreverse="true" prepend="€"
                        required/>
@endif
</div>
<div class="col-12">
@if((Auth::user()->is_owner || Auth::user()->is_restaurant) && isset($edit) && !($product->is_draft))
      <field-area label="ingredients" field="ingredients" :model="$product->translate" disabled/>
@else
      <field-area label="ingredients" field="ingredients" :model="$product->translate"/>
@endif
</div>
