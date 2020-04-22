<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <datatable route='users' :collection='$users' :fields="[
                  'ID'        => 'id',
                  'Name'      => 'name',
                  'Email'     => 'email',
                  'Role'      => 'role'
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
