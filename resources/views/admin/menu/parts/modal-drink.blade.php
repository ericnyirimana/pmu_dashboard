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
            <div class="col-8 col-md-8">
              <div class="form-group">
                  <label for="name">Name type</label>
                  <input type="text" class="form-control" id="drink_name" placeholder="Ex. Soft drink">
              </div>
            </div>
            <div class="col-2 col-md-2">
              <div class="form-group">
                  <label for="name">Quantity</label>
                  <input type="text" class="form-control" id="quantity" placeholder=""> ml
              </div>
            </div>
            <div class="col-2 col-md-2">
              <div class="form-group">
                  <label for="name">Price</label>
                  <input type="text" class="form-control" id="price" placeholder=""> $
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
