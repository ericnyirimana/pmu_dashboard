<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New type dish</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dish_type" id="type_dish" value="dish" checked>
                <label class="form-check-label" for="exampleRadios1">
                  Dish
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dish_type" id="type_dish" value="drink">
                <label class="form-check-label" for="exampleRadios2">
                  Drink
                </label>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Name type</label>
                <input type="text" class="form-control" id="dish_name" placeholder="Ex. Soft drink">

            </div>
      </div>
      <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary btn-block">Save</button>

      </div>
    </div>
  </div>
</div>