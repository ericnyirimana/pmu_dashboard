<!-- Modal -->
<div class="modal fade" id="modalDrink" tabindex="-1" role="dialog" aria-labelledby="modalDrinkLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDrinkLabel">New Drink</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
            <div class="col-12 col-lg-6">
              <field-text label="Name type" field="drink_name"  required  />

            </div>
            <div class="col-6 col-lg-3">
                <field-text-group label="Quantity" field="drink_quantity" mask="9999"  append="ml." required />

            </div>
            <div class="col-6 col-lg-3">
                <field-text-group label="Price" field="drink_price" mask="99" prepend="€" append=",00" required />

            </div>
        </div>
      </div>
      <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary btn-block">Save</button>

      </div>
    </div>
  </div>
</div>
