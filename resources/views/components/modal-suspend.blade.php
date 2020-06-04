<!-- Modal -->
<div class="modal fade suspend-register" tabindex="-1" role="dialog" aria-labelledby="suspendRegister"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">{{ ucfirst(trans('labels.modal.confirm_suspend_title')) }} <span
                        class="register-name"></span></h5>

            </div>
            <div class="modal-body">
                {{ ucfirst(trans('labels.modal.confirm_suspend_text')) }} <span class="register-name"></span>?
            </div>
            <div class="modal-footer">
                <form action="#" class="susp-accept" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="suspended" value="1" disabled="disabled" class="js-hidden-suspend"/>
                    <button class="btn btn-danger" data-dismiss="modal">{{ ucfirst(trans('button.no')) }}</button>
                    <button class="btn btn-success">{{ ucfirst(trans('button.yes')) }}</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('click', '.susp-register', function () {
                $('.js-hidden-suspend').prop('disabled', false);
                var id = $(this).data('register');
                var name = $(this).data('name');

                $('.register-name').text(name);

                $('.susp-accept').attr('action', '/admin/{{ $route }}/' + id + '/edit');
            });

        });
    </script>
@endpush
