<div class="row">
    <div class="col-12">
        <div class="table-responsive">

            <datatable route='users' :collection='$users' :fields="[
                  'ID'        => 'id',
                  'datatable.headers.name'      => 'name',
                  'datatable.headers.email'     => 'email',
                  'datatable.headers.role'      => 'role'
              ]"
                       actions="view" />

        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {

				$('#datatable').DataTable({


				});

			});

    </script>
@endpush
