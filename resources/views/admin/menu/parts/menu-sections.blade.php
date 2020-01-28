<div class="list-menu-section" id="sortable_sections">
  @if( isset($menu->sections) )

      @foreach($menu->sections as $section)
          @include('admin.menu.parts.menu-dish')
      @endforeach
  @endif
</div>

@push('modal')
@if( $menu )
  @include('admin.menu.parts.modal-type-dish')
@endif
  @include('admin.menu.parts.modal-remove')
@endpush

@push('scripts')
<script>
$(document).ready(function(){

    $( "#sortable_sections" ).sortable({
      axis: "y",
      update: function( event, ui ) {

         $(this).children('.container-sections').each(function(item, element) {

             $.ajax({
                 url: "/admin/section/position/"+$(element).data('id'),
                 type: 'POST',
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 dataType: 'json',
                 data: {position: item},
                 success: function(data) {

                 }
             });

         })
      }
    });

    $(document).on('click', '.edit-section', function(){

       var id = $(this).data('id');
       var name = $(this).data('name');
       var type = $(this).data('type');

       $("#modalTypeDishLabel").text('Edit type '+type);
       $('#modalTypeDish #type_'+ type+ '').prop('checked', true);

       $('#modalTypeDish .form-check-input').attr('disabled', true);
       $('#modalTypeDish #dish_name').val(name);
       $('#modalTypeDish #section_id').val(id);

       $('#modalTypeDish').modal('show');

    });

    $(document).on('click', '.remove-section', function() {

      var id = $(this).data('register');
      var name = $(this).data('name');
      var type = $(this).data('type');

      $('.register-name').text(name);
      $("#formDelete").attr('action', "{{ route('menu.section.destroy') }}");
      $("#formDelete").attr('data-type', type);
      $("#formDelete .inputs_form").html('');
      $("#formDelete .inputs_form").append('<input type="hidden" value="'+id+'" name="id" />');
      $("#deleteId").val(id);
      $("#typeId").val(type);


    });

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


    $(document).on('click', '.select-product', function(e) {

          if ($(this).find('input').is(':checked')) {
              $(this).removeClass("selected");
              $(this).find('input').prop('checked', false);

          } else {
              $(this).addClass("selected");
              $(this).find('input').prop('checked', true);
          }

    });
});

function removeSection(id) {

    $('#section-'+id).remove();

}

function removeItem(id) {

    $('#item-'+id).remove();

}
</script>
@endpush
