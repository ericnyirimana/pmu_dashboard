<!-- Modal -->
<div class="modal fade" id="modalTypeDish" tabindex="-1" role="dialog" aria-labelledby="modalTypeDishLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTypeDishLabel">New type dish</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formType" action="" method="post">
        <div class="modal-body">

            <field-radio field="type" :items="['Dish', 'Drink']" required />

            <field-text label="Name type" field="name" id="dish_name" required  />

        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" id="section_id" value="" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary btn-block" id="save-section">Save</button>

        </div>
      </form>
    </div>
  </div>
</div>
@push('scripts')
<script>
$(document).ready(function(){

  $(document).on('click', '#save-section', function(e){
      e.preventDefault();

      var id = $('#section_id').val();


      if (id) {

            $.ajax({
                url: "{{ route('menu.section.save', $menu->id ) }}",
                type: 'PUT',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('#formType').serialize(),
                success: function(data) {
                    console.log(data);

                    $('#section-'+data.id).find('.title-section').html( $('#dish_name').val() );

                    $('#modalTypeDish').modal('toggle');

                }
            });
        } else {

            $.ajax({
                url: "{{ route('menu.section.update', $menu->id ) }}",
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('#formType').serialize(),
                success: function(data) {

                    $('#section-'+id).remove();
                    console.log(id, $('#section-'+id).text());

                    $('.list-menu-section').append(data);

                    $('#modalTypeDish').modal('toggle');

                }
            });
        }


  })

});
</script>
@endpush
