<!-- Modal -->
<div class="modal fade" id="modalDish" tabindex="-1" role="dialog" aria-labelledby="modalDishLabel" aria-hidden="true">
  <div class="modal-dialog modal-full" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDishLabel">New dish</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            @php $product = null; $brands = null; $restaurants = null; @endphp
            @include('admin.products.parts.form')
      </div>
      <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary btn-block">Save</button>

      </div>
    </div>
  </div>
</div>
