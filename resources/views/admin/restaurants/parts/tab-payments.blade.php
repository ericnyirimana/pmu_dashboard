<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>Storico pagamenti</b></h4>

            {{--<datatable route='orders' :collection="$restaurant->orders" :fields="[--}}
                {{--'ID' => 'id',--}}
                {{--]"--}}
                       {{--actions='edit' />--}}
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
