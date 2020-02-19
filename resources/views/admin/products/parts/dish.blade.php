<div class="col-lg-9 col-md-7">
      <field-text label="Name" field="name" :model="$product->translation" required  />
</div>
<div class="col-lg-3 col-md-5">
      <field-text-group label="Price" field="price" :model="$product" mask="#,##" maskreverse="true" prepend="€" required />
</div>
<div class="col-12">
      <field-tags label="Food" field="foods" :values="$product->foods->pluck('translation.name')" :list="$foods" required  />
</div>
<div class="col-12 col-md-6">
      <field-area label="Description" field="description" id="dish-description" :model="$product->translation" required  />
</div>
<div class="col-12 col-md-6">
      <field-area label="Ingredients" field="ingredients" :model="$product->translation" required  />
</div>
<div class="col-12">
      <field-tags label="Allergens" field="allergens" :values="$product->allergens->pluck('translation.name')" :list="$allergens" required  />
</div>
<div class="col-12">
      <field-tags label="Dietaries" field="dietaries" :values="$product->dietaries->pluck('translation.name')" :list="$dietaries" required  />
</div>