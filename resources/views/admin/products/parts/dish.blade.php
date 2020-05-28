<div class="col-lg-9 col-md-7">
      <field-text label="name" field="name" :model="$product->translate" required  />
</div>
<div class="col-lg-3 col-md-5">
      <field-text-group label="price" field="price" :model="$product" mask="#,##" maskreverse="true" prepend="€"
                        required />
</div>
<div class="col-12">
      <field-tags label="food" field="foods" :values="$product->foods->pluck('translate.name')" :list="$foods"
                  required  />
</div>
<div class="col-12 col-md-6">
      <field-area label="description" field="description" id="dish-description" :model="$product->translate"  />
</div>
<div class="col-12 col-md-6">
      <field-area label="ingredients" field="ingredients" :model="$product->translate"  />
</div>
<div class="col-12">
      <field-tags label="allergens" field="allergens" :values="$product->allergens->pluck('translate.name')"
                  :list="$allergens" />
</div>
<div class="col-12">
      <field-tags label="dietaries" field="dietaries" :values="$product->dietaries->pluck('translate.name')"
                  :list="$dietaries" />
</div>
