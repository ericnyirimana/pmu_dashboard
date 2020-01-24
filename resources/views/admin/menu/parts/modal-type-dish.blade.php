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
      <form id="formTypeDish">
        <div class="modal-body">

            <field-radio field="type" :items="['Dish', 'Drink']" required />

            <field-text label="Name type" field="name" id="dish_name" required  />

        </div>
        <div class="modal-footer">

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

      $.ajax({
          url: "{{ route('menu.section.data', $menu->id ) }}",
          type: 'POST',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: $('#formTypeDish').serialize(),
          success: function(data) {

              $('.list-menu-section').append(data);

              $('#modalTypeDish').modal('toggle');

          }
      });

  })

});
</script>
@endpush
