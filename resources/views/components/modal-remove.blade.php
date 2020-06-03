<!-- Modal -->
<div class="modal fade remove-register" tabindex="-1" role="dialog" aria-labelledby="removeRegister" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">{{ ucfirst(trans('labels.modal.confirm_remove_title')) }} <span
                        class="register-name"></span></h5>

            </div>
            <div class="modal-body">
                {{ ucfirst(trans('labels.modal.confirm_remove_text')) }} <span class="register-name"></span>?
            </div>
            <div class="modal-footer">
                <form action="#" class="rm-accept" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" data-dismiss="modal">{{ ucfirst(trans('button.no')) }}</button>
                    <button type="submit" class="btn btn-success">{{ ucfirst(trans('button.yes')) }}</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('click', '.rm-register', function () {

                var id = $(this).data('register');
                var name = $(this).data('name');

                $('.register-name').text(name);

                $('.rm-accept').attr('action', '/admin/{{ $route }}/' + id);
            });

        });
    </script>
@endpush
