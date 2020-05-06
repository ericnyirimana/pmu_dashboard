<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.list_orders')) }}</b></h4>

                <datatable route='orders' :collection="$orders" :fields="[
                'datatable.headers.date'      => 'date',
                'datatable.headers.hour'      => 'hour',
                'ID' => 'id',
                'datatable.headers.offer'      => 'pickup_id',
                'datatable.headers.price' => 'offer_price',
                'datatable.headers.status'      => 'status',
                ]"
                actions='view' />
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
			$(document).ready(function() {



			});

    </script>
@endpush
