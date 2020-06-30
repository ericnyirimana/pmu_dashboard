<!-- Modal -->
<div id="cancel-modal" class="modal fade js-button-cancel-{{ $ticket->id }}" tabindex="-1" role="dialog" aria-labelledby="suspendRegister"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <div id="error-modal-{{ $ticket->id }}"></div>
                <h5 class="modal-title mt-0">{{ ucfirst(trans('labels.modal.confirm_cancel_ticket')) }} <span
                        class="register-name"></span></h5>

            </div>
            <div class="modal-body">
            <div class="col-12">
                        <div class="form-group h-100">
                            <label for="restaurant_notes">Note</label>
                            <textarea class="form-control" name="restaurant_notes_{{ $ticket->id }}" id="restaurant_notes_{{ $ticket->id }}" aria-describedby="restaurant_notesHelp" parsley-trigger="change" required="" spellcheck="false"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer"  id="cancel_{{ $ticket->id }}">
                    <button class="btn btn-danger" data-dismiss="modal">{{ ucfirst(trans('button.no')) }}</button>
                    <button type="click" value="{{ $ticket->id }}" class="btn btn-success approve-cancelation">{{ ucfirst(trans('button.yes')) }}
                    <i class="fa fa-circle-o-notch fa-spin" style="font-size:19px"></i>
                    </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->