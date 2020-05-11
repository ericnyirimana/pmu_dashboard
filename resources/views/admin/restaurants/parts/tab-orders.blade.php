<div class="row">
    <div class="col-12">
        <div class="table-responsive">

            <h4 class="m-t-0 header-title"><b>{{ ucfirst(trans('datatable.history_orders')) }}</b></h4>

                <datatable route='orders-pickup' :collection="$ordersPickup" :fields="[
                'datatable.headers.date'      => 'order:date_format',
                'datatable.headers.hour'      => 'order:hour_format',
                'ID' => 'order:id',
                'datatable.headers.offer'      => 'pickup:name',
                'datatable.headers.price' => 'pickup:price',
                'datatable.headers.status'      => 'order:status',
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
