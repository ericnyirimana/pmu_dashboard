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
              <div class="form-group">
                  <label for="name">Name type</label>
                  <input type="text" class="form-control" id="drink_name" placeholder="Ex. Soft drink">
              </div>
            </div>
            <div class="col-6 col-lg-3">
                <label for="name">Quantity</label>
                <div class="input-group mb-3">
                    <input type="text" name="quantity" class="form-control" aria-label="Quantity">
                    <div class="input-group-append">
                        <span class="input-group-text">ml.</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <label for="name">Price</label>
                <div class="input-group mb-3">

                    <div class="input-group-prepend">
                        <span class="input-group-text">€</span>
                    </div>
                    <input type="text" name="amount" class="form-control" aria-label="Amount">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
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
