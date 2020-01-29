<div class="col-lg-9 col-md-7">
      <field-text label="Name" field="name" :model="$product->translation" required  />
</div>
<div class="col-lg-3 col-md-5">
      <field-text-group label="Price" field="price" :model="$product" mask="#,##" maskreverse="true" prepend="€" required />
</div>
<div class="col-12">
      <field-tags label="Categories" field="categories" values="categories_array" :model="$product->translation" :list="$categories['foods']" required  />
</div>
<div class="col-12 col-md-6">
      <field-area label="Description" field="description" id="dish-description" :model="$product->translation" required  />
</div>
<div class="col-12 col-md-6">
      <field-area label="Ingredients" field="ingredients" :model="$product->translation" required  />
</div>
<div class="col-12">
      <field-tags label="Allergens" field="allergens" values="allergens_array" :model="$product->translation" :list="$categories['allergens']" required  />
</div>
<div class="col-12">
      <field-tags label="Diets" field="dietary" values="dietary_array" :model="$product->translation" :list="$categories['dietary']" required  />
</div>
