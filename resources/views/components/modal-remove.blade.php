<!-- Modal -->
<div class="modal fade remove-register" tabindex="-1" role="dialog" aria-labelledby="removeRegister" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Remove register <span class="register-name"></span></h5>

            </div>
            <div class="modal-body">
                Do you want to remove the register <span class="register-name"></span>?
            </div>
            <div class="modal-footer">
                <form action="#" class="rm-accept" method="POST">
                  @csrf
                  @method('delete')
                <button class="btn btn-danger" data-dismiss="modal">No</button> <button class="btn btn-success">Yes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

    $(document).on('click', '.rm-register', function(){

            var id = $(this).data('register');
            var name = $(this).data('name');

            $('.register-name').text(name);

            $('.rm-accept').attr('action', '/admin/{{ $route }}/'+id);
    });

});
</script>
@endpush
