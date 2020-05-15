<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            @if(isset($users))
            <datatable class='account-datatable' route='users' :collection='$users' :fields="[
                  'ID'        => 'id',
                  'datatable.headers.name'      => 'name',
                  'datatable.headers.email'     => 'email',
                  'datatable.headers.role'      => 'role'
              ]"
                       actions="edit" />
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {

				$('.account-datatable').dataTable({
                    "language": {
                        "url": "cdn.datatables.net/plug-ins/1.10.20/i18n/Italian.json"
                    }
				});
			});

    </script>
@endpush
