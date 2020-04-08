<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>List users</b></h4>

            {{--<datatable route='users' :collection='$restaurants->users' :fields="[--}}
                  {{--'ID'        => 'id',--}}
                  {{--'Name'      => 'name',--}}
                  {{--'Email'     => 'email',--}}
                  {{--'Role'      => 'role'--}}
              {{--]"--}}
                       {{--actions="edit, delete" />--}}

        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {

				// $('#datatable').DataTable({
                //
                //
				// });

			});

    </script>
@endpush
