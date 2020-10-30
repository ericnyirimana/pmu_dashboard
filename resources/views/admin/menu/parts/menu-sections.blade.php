<div class="list-menu-section accordion" id="sortable_sections">
  @if( isset($menu->sections) )

      @foreach($menu->sections as $section)
          @include('admin.menu.parts.menu-dish')
      @endforeach

  @endif
</div>

@push('modal')
@if( $menu->id )
  @include('admin.menu.parts.modal-type-dish')
  @include('admin.menu.parts.modal-dish')
  @include('admin.menu.parts.modal-drink')
  @include('admin.menu.parts.modal-remove')
@endif
@endpush

@push('scripts')
<script>
$(document).ready(function(){

    $( "#sortable_sections" ).sortable({
      axis: "y",
      update: function( event, ui ) {

         $(this).children('.container-sections').each(function(item, element) {
             $.ajax({
                 url: "{{ route('section.position') }}/"+$(element).data('id'),
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

    // Add minus icon for collapse element which is open by default
    $(".collapse.show").each(function(){
        	$(this).prev(".section-header").find(".fa-angle-down").addClass("fa-angle-up").removeClass("fa-angle-down");
        });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function(){
      $(this).prev(".section-header").find(".fa-angle-down").removeClass("fa-angle-down").addClass("fa-angle-up");
    }).on('hide.bs.collapse', function(){
      $(this).prev(".section-header").find(".fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");
    });
});

function removeSection(id) {

    $('#section-'+id).remove();

}

function removeItem(id) {

    $('#item-'+id).remove();

}

$( function() {

  $(document).on('click', '.btn-open-dish', function(e){
      console.log('open this');
      section = $(this).data('section');

      $('#modalDish').modal('toggle');

      $("#formAddDishes #add_dish_section_id").val(section);

  });

  $(document).on('click', '.btn-open-drink', function(e){

      section = $(this).data('section');

      $('#modalDrink').modal('toggle');

      $("#formAddDrinks #add_drink_section_id").val(section);

  });

   $( ".sortable_dish" ).sortable({
     axis: "y",
     update: function( event, ui ) {

        $(this).children('.container-plate-preview').each(function(item, element) {

            $.ajax({
                url: "/products/position/"+$(element).data('id'),
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

 } );
 </script>
@endpush
