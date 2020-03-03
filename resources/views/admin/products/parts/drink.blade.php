<div class="col-lg-6 col-md-12">
      <field-text label="Name" field="name" :model="$product->translate" required  />
</div>
<div class="col-lg-3 col-md-6">
      <field-text label="Quantity" field="description" id="drink-description" :model="$product->translate" mask="#.### ml." maskreverse="true" required  />
</div>
<div class="col-lg-3 col-md-6">
      <field-text-group label="Price" field="price" :model="$product" mask="##,##" maskreverse="true" prepend="€" required />
</div>
<div class="col-12">
      <field-area label="Ingredients" field="ingredients" :model="$product->translate" required  />
</div>
