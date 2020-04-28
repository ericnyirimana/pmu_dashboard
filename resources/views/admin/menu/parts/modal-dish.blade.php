<!-- Modal -->
<div class="modal fade" id="modalDish" tabindex="-1" role="dialog" aria-labelledby="modalDishLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDishLabel">New dish</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAddDishes" onsubmit="return false;">
          <input type="hidden" value="" name="section_id" id="add_dish_section_id" />
          @if($dishesProducts->isEmpty())
              The restaurant has no products
          @endif
          @foreach ($dishesProducts as $product)
          <div class="container-plate-preview select-product" data-id="{{ $product->id }}" id="item-{{ $product->id }}">
              <input type="checkbox" value="{{ $product->id }}" id="select-dish-{{ $product->id }}" class="add-products" name="add_products[]" />
              <div class="plate-preview-text">
                <h5>{{ $product->translate->name }}</h5>
                <p>{{ $product->translate->description }}</p>
              </div>
              <div class="plate-preview-price">
                  € {{ $product->price }}
              </div>
          </div>
          @endforeach
        </form>
      </div>
      <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(trans('button.delete')) }}</button>
          <button type="button" class="btn btn-primary btn-block btn-add-dishes">{{ ucfirst(trans('button.add')) }}</button>

      </div>
    </div>
  </div>
</div>
@push('scripts')
<script>
$(document).ready(function() {

    $(document).on('click', '.btn-add-dishes', function(e) {
          e.preventDefault();

          $.ajax({
            url: "{{ route('section.product.add') }}",
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data: $('#formAddDishes').serialize(),
            success: function(data) {

              if (!data.error) {
                $.each(data.views, function(i, html){
                    $("#sortable_dish_"+data.id).append(html);
                });
            }



          }, complete: function() {

              $('#formAddDishes input').each(function(i, item){
                $(item).prop('checked', false);
                $(item).parent().removeClass('selected');
              });
              $('#modalDish').modal('toggle');
            }
          });
    });


});
</script>
@endpush
