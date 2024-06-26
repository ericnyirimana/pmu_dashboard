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

            <field-radio field="type" :items="['Dish' => 'Dish', 'Drink' => 'Drink']" required />

            <field-text label="name_type" field="name" id="dish_name" required  />

        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" id="section_id" value="" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(trans('button.delete')) }}</button>
            <button type="submit" class="btn btn-primary btn-block" id="save-section">{{ ucfirst(trans('button.save')) }}</button>

        </div>
      </form>
    </div>
  </div>
</div>
@push('scripts')
<script>
$(document).ready(function(){

  $(document).on('submit', '#formType', function(e){
      e.preventDefault();

      var id = $('#section_id').val();

      if (id) {

            $.ajax({
                url: "{{ route('menu.section.save', $menu->id ) }}",
                type: 'PUT',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('#formType').serialize(),
                success: function(data) {

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

                    $('.list-menu-section').append(data);

                    $('#modalTypeDish').modal('toggle');

                }, error: function(data){
                    $('#formType .parsley-errors-list').remove();
                    $('#dish_name').parent().append('<ul class="parsley-errors-list filled" id="parsley-id-24"><li class="parsley-required">'+data.responseText+'</li></ul>');
                }
            });
        }


  })

});
</script>
@endpush
