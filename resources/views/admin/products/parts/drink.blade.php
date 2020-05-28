<div class="col-lg-6 col-md-12">
      <field-text label="name" field="name" :model="$product->translate" required  />
</div>
<div class="col-lg-3 col-md-6">
      <field-text label="capacity" field="description" id="drink-description" :model="$product->translate"
                  mask="#.### ml." maskreverse="true" />
</div>
<div class="col-lg-3 col-md-6">
      <field-text-group label="price" field="price" :model="$product" mask="##,##" maskreverse="true" prepend="€"
                        required />
</div>
<div class="col-12">
      <field-area label="ingredients" field="ingredients" :model="$product->translate" />
</div>
