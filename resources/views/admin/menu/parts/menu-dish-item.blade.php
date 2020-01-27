<div class="container-plate-preview" data-id="{{ $product->id }}" id="item-{{ $product->id }}">
    <figure><i class="fa fa-file-image-o fa-2x"></i></figure>
    <div class="plate-preview-text">
      <h4>{{ $product->translation->name }}</h4>
      <p>{{ $product->translation->description }}</p>
    </div>
    <div class="plate-preview-price">
        € {{ $product->price }}
    </div>
    <div class="plate-preview-actions">
          <div class="plate-action-icon plate-move">
              <i class="fa fa-arrows text-dark"></i>
          </div>
          <div class="plate-action-icon plate-edit plate-remove" data-type="item" data-name="{{ $product->translation->name }}" data-section_id="{{ $section->id }}" data-product_id="{{ $product->id }}" data-toggle="modal" data-target=".remove-register">
              <i class="fa fa-trash text-danger"></i>
          </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function(){

    $(document).on('click', '.plate-remove', function() {

      var product_id = $(this).data('product_id');
      var section_id = $(this).data('section_id');
      var name = $(this).data('name');
      var type = $(this).data('type');

      $('.register-name').text(name);
      $("#formDelete").attr('action', "{{ route('product.ajax.destroy') }}");
      $("#formDelete").attr('data-type', type);

      $("#formDelete .inputs_form").html('');

      $("#formDelete .inputs_form").append('<input type="hidden" value="'+product_id+'" name="product_id" />');
      $("#formDelete .inputs_form").append('<input type="hidden" value="'+section_id+'" name="section_id" />');
      $("#typeId").val(type);

      $('.register-name').text(name);

    });
});

function removeItem(id) {

    $('#item-'+id).remove();

}
</script>
@endpush
