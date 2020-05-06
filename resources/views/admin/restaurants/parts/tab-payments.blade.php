<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.history_payments')) }}</b></h4>

            {{--<datatable route='payment' :collection="$payment" :fields="[--}}
                {{--'datatable.headers.date_hour'      => 'created_at',--}}
                {{--'ID' => 'id',--}}
                {{--'datatable.headers.offer'      => 'name',--}}
                {{--'datatable.headers.price' => 'price',--}}
                {{--'datatable.headers.status'      => 'status',--}}
                {{--]"--}}
                       {{--actions='view' />--}}
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
