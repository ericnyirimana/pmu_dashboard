<!-- Modal Remove Dish -->
<div class="modal fade remove-register" id="modalRemoveContainer" tabindex="-1" role="dialog" aria-labelledby="removeRegister" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Remove</h5>

            </div>
            <div class="modal-body">
                Do you want remove <span class="register-name"></span>?
            </div>
            <div class="modal-footer">
                <form id="formDelete" action="#" class="rm-accept" method="POST">
                  <input type="hidden" name="type" value="" id="typeId" />
                  <div class="inputs_form"></div>
                <button class="btn btn-danger" data-dismiss="modal">{{ ucfirst(trans('button.no')) }}</button> <button class="btn btn-success">{{ ucfirst(trans('button.yes')) }}</button>
              </form>
            </div>
            <ul class="parsley-errors-list filled">
                <li class="parsley-required" id="show-error" style="display:none;"></li>
            </ul>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@push('scripts')
<script>
$(document).ready(function(){

    $('#modalRemoveContainer').on('hide.bs.modal', function (e) {
        console.log('close');
        $('#show-error').text('').hide();
    })

  $(document).on('submit', '.rm-accept', function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: 'DELETE',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json',
        data: $('#formDelete').serialize(),
        success: function(data) {
              if (data.id) {
                  var type = $('#typeId').val();

                  if (type == 'section') {
                      removeSection(data.id);
                  }

                  if (type == 'item') {
                      removeItem(data.id);
                  }

                  $('#modalRemoveContainer').modal('toggle');
              } else if (data.error) {
                  $('#show-error').text(data.error).show();
              }

        }
    });

  });


});
</script>
@endpush
